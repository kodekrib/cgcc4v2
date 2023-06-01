<?php

namespace App\Console;

use App\Http\Controllers\Admin\MailingSetupController;
use App\Mail\MailNotify;
use App\Models\Meeting;
use App\Models\Member;
use App\Models\MembersAffinityGroup;
use App\Models\Notification;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];


    protected function schedule(Schedule $schedule)
    {
        /**
         * Affinity group job: this is update Member affinty group where they are above 50
         */
        $schedule->call(function () {
            $members = Member::all();
            foreach ($members as $key => $value) {
                $marital_status = $value->marital_status;
                //$value->setDateOfBirthAttribute($value->date_of_birth);
                $date_of_birth = Carbon::parse(Carbon::createFromFormat(config('panel.date_format'), $value['date_of_birth'])->format('Y-m-d'));

                $dt = now();

                $age = $date_of_birth->diffInYears($dt, false);


                if($age >= 50){
                    $affinity_group = 'Crown of Glory';
                    if($marital_status == 'married'){
                        $affinity_group = 'Crown of Glory, Couple Fellowship';
                    } else if(in_array($marital_status, array('widow', 'widower', 'divorced', 'separated', 'single parent'))){
                        $affinity_group = 'Crown of Glory, 686 Fellowship';
                    }
                    $value->update(['affinity_group'  => $affinity_group, 'age' => $age]);

                    $created = MembersAffinityGroup::where('created_by_id', $value->id)->first();

                    if($created != null){

                        $created->update(['affinity_group'  => $affinity_group]);
                    }
                } else {
                    $value->update(['age' => $age]);
                }


            }

        })->everyMinute();

        $schedule->call(function () {
            $datetime = now()->addHour()->isoFormat('YYYY-MM-DD HH:mm:ss');
            $date = now()->addHour()->isoFormat('MM-DD-YYYY');
            $meets = Meeting::where('approval_status', 2)->Where('date_of_meeting', 'like', '%awaiting%')->get();

            foreach ($meets as $key => $value) {
                $dateList = json_decode($value->date_of_meeting);
                info($date);
                //info($dateList);
                $check = collect($dateList)->where('status','awaiting')->where('date', $date)->first();

                if($check != null){
                    $arrDateString = explode('-', $check->date);
                    $startDate =  $arrDateString[2].'-'.$arrDateString[0].'-'.$arrDateString[1];
                    $d = $startDate. ' '. $check->time;

                    $to = Carbon::createFromFormat('Y-m-d H:i:s', $datetime);
                    $from = Carbon::createFromFormat('Y-m-d H:i:s', $d);

                   info('----------------------------------------');
                   info($to);
                   info($from);
                   $diff_in_minute = $to->diffInMinutes($from);

                   if($diff_in_minute >= 0  && $to >= $from){
                    $position = array_search($check, $dateList);

                    $dateList[$position]->status = 'active';


                    //collect($dateList)->where('status','awaiting' )->replace($check);
                    $date_of_meeting = json_encode($dateList);
                    $value->update(['date_of_meeting'=> $date_of_meeting]);
                   }
                }
            }
        })->everyMinute();


        /**
         * This is close a meeting date and open another meeting day
         */

        $schedule->call(function () {

            $date = now()->addHour()->isoFormat('YYYY-MM-DD HH:mm:ss'); //now()->addHour()->isoFormat('MM-DD-YYYY');
            $time = now()->addHour()->isoFormat('HH:mm');
            info($date);
            $meets = Meeting::where('approval_status', 2)->Where('date_of_meeting', 'like', '%active%')->get();
            info($meets);
            $that = $this;
            foreach ($meets as $key => $value) {

                $dateList = json_decode($value->date_of_meeting);

                $check = collect($dateList)->where('status','active' )->first();
               if($check != null){
                $arrDateString = explode('-', $check->date);
                $startDate =  $arrDateString[2].'-'.$arrDateString[0].'-'.$arrDateString[1];

                $d = $startDate. ' '. $check->time;
                 $to = Carbon::createFromFormat('Y-m-d H:i:s', $date);
                 $from = Carbon::createFromFormat('Y-m-d H:i:s', $d);


                info($to);
                info($from);
                $diff_in_minute = $to->diffInMinutes($from);
                info($diff_in_minute);
                if(($diff_in_minute + $value->time_duration) >= 60){
                    $position = array_search($check, $dateList);

                    $dateList[$position]->status = 'Closed';
                    if(count($dateList) - 1 >= $position){
                        $dateList[$position + 1]->status = 'awaiting';
                    }

                    //collect($dateList)->where('status','active' )->replace($check);
                    $date_of_meeting = json_encode($dateList);
                    $value->update(['date_of_meeting'=> $date_of_meeting]);
                }

               }

            }
        })->everyFiveMinutes();

        /**
         * The is to send a mail to all attendee of a particular meeting period
         */

        $schedule->call(function () {
            $members = Member::all();
            $datefrom = now()->addHour()->isoFormat('MM-DD-YYYY');
            $dateto = now()->addDays(2)->addHour()->isoFormat('MM-DD-YYYY');
            $meets = Meeting::where('approval_status', 2)->Where('date_of_meeting', 'like', '%awaiting%')->get();

            foreach ($meets as $key => $value) {
                $dateList = json_decode($value->date_of_meeting);
                // info($datefrom);
                // info($dateto);
                // info($dateList);
                $check = collect($dateList)->where('status','awaiting')->whereBetween('date', [$datefrom,$dateto])->first();

                if($check != null){
                    $attendee = $members->whereIn('id',json_decode($value->attendees_id_list) );
                    //info($attendee);
                    $emailList = array();
                    foreach ($attendee as $lable => $val) {
                        array_push($emailList, $val->email);
                        $mailSeting = (new MailingSetupController);
                        $data['subject'] = 'Meeting Invitation';
                        $data['template'] =  $mailSeting->BuildEmailTemplate('8',  $val->id, [], false);

                        try {
                            Mail::to($val->email)->send(new MailNotify($data));
                        } catch (Exception $th) {

                        }
                    }
                    //info(json_encode($emailList));


                }
            }
        })->daily();



        /**
         * Notification
         */

        $schedule->call(function () {
            $notification = Notification::with(['emails'])->where('date', now()->toDateString())->get();

            foreach ($notification as $key => $value) {
                info($value['message_title']);

                $data['subject'] = $value['message_title'];
                $data['template'] = $value['message'] ;
                $emailist = [];

                foreach ($value['emails'] as $email) {
                    array_push($emailist, $email);
                }
                try {
                    Mail::to($emailist)->send(new MailNotify($data));
                } catch (Exception $th) {

                }
            }
        })->daily();

        /**
         * Reminder
         */

        $schedule->call(function () {
            $reminders = Reminder::with(['memberinfo'])->where('reminder_date', now()->toDateString())->get();
            foreach ($reminders as $key => $value) {
                $data['subject'] = $value['subject'];
                $data['template'] = $value['description'] ;

                try {
                    Mail::to($value['memberinfo']['email'])->send(new MailNotify($data));
                } catch (Exception $th) {

                }
            }

        })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
