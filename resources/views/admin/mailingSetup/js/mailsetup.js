
let memberList = [];
let mailList = [];
let operationCode;
let  category = [];
let editor;
let selectMember = [];
let DepartmentList =[];
let inbuiltParameter = JSON.parse("{{ $inbuiltParameter }}".replace(/&quot;/g,'"'));
var selectedTemplate =0;
function OnchangeOperationCode(){
  operationCode = $('#mailing_operation_code').val();
  if(operationCode !== null && operationCode !== undefined){

      document.getElementById('btnAdd').style.display='block';
  } else {
      document.getElementById('btnAdd').style.display='none';
  }
  GetEmailSettingByOperationCode(operationCode);
}

function GetMemberList(){
this.Get('/admin/user/GetUserList').then(res => {
  memberList = res.data;
}).catch((error) => {
      console.log(error)
});
}


function GetEmailSettingByOperationCode(operationCode){
  this.Get('/admin/mailingSetup/getMailingSetup/' + operationCode).then(res => {
      console.log(res)
      const list = document.getElementById('emailCOntainer');
      list.innerHTML = "";
      mailList = res.data;
      BuildMailSettingList();
  }).catch((error) => {
      console.log(error)
  });
}

function AddEmailSetting(){
  let number_email_count = $('#number_email').val()
  let category =$(`#select_${mailList.length + 1}`).val()
  const itm = {
      id: 0,
      mailing_operation_code: Number.parseInt(operationCode),
      number_email: number_email_count !== undefined && number_email_count !== ''?number_email_count: 0,
      category: null,
      level: mailList.length + 1,
      member_ids : null

  };
  mailList.push(itm);
  BuildMailSettingList();
}

function Number_Email_change(){
  let number_email_count = $('#number_email').val();
  $.each(mailList, (i, v) => {
      v.number_email = number_email_count?? 0;
  });
}



function submitMailSetup(){
  this.Post('/admin/mailingSetup/AddMailSetting', {data: mailList}, true).then(res =>{
     SuccessNotification("Successfull Save");
      GetEmailSettingByOperationCode(operationCode);
  }).catch((error) => {
      console.log(error)
  });

}

function submitMailTemplate(){
  const mailing_operation_code = $('#mailing_operation_code_template').val();

  if( mailing_operation_code == undefined || mailing_operation_code === null){
      ErrorNotification('OperationCode is not selected, please kindly select a valid opereation code');
      return;
  } else  if(editor == undefined || editor == null){
      ErrorNotification('Template cannot be empty, please kindly supply a valid template')
      return;
  }

  var item = {
      id: selectedTemplate,
      mailing_operation_code: Number.parseInt(mailing_operation_code),
      template: editor.getData()
  }

 // editor.then(res => item.template = res.getData());

  this.Post('/admin/mailingSetup/CreateMailingTemplate', item).then(res =>{
      SuccessNotification('Successfully Saved');
      GetMailTemplateByOperaionCode();
  }).catch((error) => {
      console.log(error)
  });

}

function GetMailTemplateByOperaionCode(){
  const mailing_operation_code = $('#mailing_operation_code_template').val();
  this.Get('/admin/mailingSetup/getMailingTemplate/' + mailing_operation_code).then(res => {
      console.log(res)
      if(res !== null){
          editor.setData(res.template);
          selectedTemplate = res.id;
      } else{
          selectedTemplate = 0;
          editor.setData('')
      }


  }).catch((error) => {
      selectedTemplate = 0;
      editor.setData('')
  });
}

function onChangeSelectMemeber(name, level){
  var selectId = $(`#${name}`).val();
  var index = mailList.findIndex(x => x.level === level);
  if(index > -1  && selectId !== null && selectId !== undefined){
     const member_ids = JSON.parse(mailList[index].member_ids ?? '[]');
     member_ids.push(Number.parseInt(selectId));
     mailList[index].member_ids = JSON.stringify(member_ids);
  }


}

function onChangeSelectDept(name, level){
  debugger;
  document.getElementById(`hodpanel_${level}`).style.display ='block';
  var category = $(`#select_${level}`).val();
  var dept = $(`#${name}`).val();

  var index = mailList.findIndex(x => x.level === level);
  if(index > -1  && category !== null && category !== undefined && dept !== null && dept !== undefined){
      mailList[index].member_ids = '';
      mailList[index].category = category;
      const mem = [];
      mem.push(Number.parseInt(dept));
      mailList[index].member_ids = JSON.stringify(mem)
  }
}

function onChangeSelectCategory(name, level){
  debugger;
  var category = $(`#${name}`).val();
  var index = mailList.findIndex(x => x.level === level);
  if(index > -1  && category !== null && category !== undefined){

     mailList[index].category = category;
     if(category === 'member'){
      document.getElementById(`memberpanel_${level}`).style.display ='block';
     // document.getElementById(`deparmentpanel_${level}`).style.display ='none';
       document.getElementById(`hodpanel_${level}`).style.display ='none';

     } else {
      document.getElementById(`memberpanel_${level}`).style.display ='none';
      //document.getElementById(`deparmentpanel_${level}`).style.display ='block';
      //if(mailList[index].member_ids !== null && category === 'department'){
      document.getElementById(`hodpanel_${level}`).style.display ='block';
      //}
      mailList[index].member_ids = null;
     }
  }
}

function GetDepartmentList(){
  this.Get('/admin/departments/getDepartmentList').then(res => {
      DepartmentList = res;
  }).catch(err => {

  })
}

function BuildMailSettingList(){

  const list = document.getElementById('emailCOntainer');
  list.innerHTML = "";
  const name = "{{ trans('cruds.mailingSetup.fields.category') }}";
  const memberName = "{{ trans('cruds.mailingSetup.fields.memberName') }}";
  if(mailList.length > 0){
      $('#number_email').val(mailList[0].number_email ==0?'':mailList[0].number_email)
      document.getElementById('btnSubmit').style.display='block';
  } else {
      document.getElementById('btnSubmit').style.display='none';
  }
  $.each(mailList, (i , value)  => {
      const item = document.createElement('div');
      item.className = "shadow p-3 mb-5 bg-white rounded";
      const row = document.createElement('div');
      row.className = "row";

      const operationCodeDiv = document.createElement('div');
      operationCodeDiv.className = "col-4 form-group";
      const lable = document.createElement('label');
      lable.className = "required";
      lable.htmlFor = "operationCode";
      lable.textContent = name;
      operationCodeDiv.appendChild(lable);

      const operationCodeSelect =  document.createElement('select');
      operationCodeSelect.className = "form-control";
      operationCodeSelect.setAttribute('id', `select_${value.level}`);
      let opt = document.createElement('option');
      opt.disabled = true;
      opt.selected = value.category !== undefined&& value.category !== null?false:true;
      opt.text = "{{ trans('global.pleaseSelect') }}";
      opt.value = null;
      operationCodeSelect.appendChild(opt);
      operationCodeSelect.addEventListener('change', () => onChangeSelectCategory(`select_${value.level}`, value.level))

      $.each(category, (i, v) => {
          opt = document.createElement('option');
              if(value.category === i){
                  opt.selected = true;
              } else {
                  opt.selected = false;
              }
              opt.text = v;
              opt.value = i;
              operationCodeSelect.appendChild(opt);
      });
      operationCodeDiv.appendChild(operationCodeSelect);
      row.appendChild(operationCodeDiv);

      const memberDiv = document.createElement('div');
      memberDiv.className = "col-4 form-group";
      memberDiv.setAttribute('id', `memberpanel_${value.level}`);
      memberDiv.style.display = value.category == 'member'?'block': 'none';
      const memberlable = document.createElement('label');
      memberlable.className = "required";
      memberlable.htmlFor = "Member";
      memberlable.textContent = memberName;
      memberDiv.appendChild(memberlable);

      const memberSelect =  document.createElement('select');
      memberSelect.className = "form-control";
      memberSelect.setAttribute('id', `member_${value.level}`);
      let memberOpt = document.createElement('option');
      memberOpt.disabled = true;
      memberOpt.selected = value.member_ids !== undefined&& value.member_ids !== null?false:true;
      memberOpt.text = "{{ trans('global.pleaseSelect') }}";
      memberOpt.value = null;
      memberSelect.appendChild(memberOpt);
      memberSelect.addEventListener('change', () => onChangeSelectMemeber(`member_${value.level}`, value.level))
      const member_ids = JSON.parse(value.member_ids ?? '[]');
      $.each(memberList, (i, v) => {
          memberOpt = document.createElement('option');
              var dt = member_ids.findIndex(m => m == v.id);

              if(dt > -1 && value.category === 'member'){
                  memberOpt.selected = true;
              } else {
                  memberOpt.selected = false;
              }
              memberOpt.text = v.name;
              memberOpt.value = v.id;
              memberSelect.appendChild(memberOpt);
      });
      memberDiv.appendChild(memberSelect);
      row.appendChild(memberDiv);


      const deparmentDiv = document.createElement('div');
      deparmentDiv.className = "col-4 form-group";
      deparmentDiv.setAttribute('id', `deparmentpanel_${value.level}`);
      deparmentDiv.style.display = value.category == 'department'?'block': 'none';

      // let deparmentCol= `
      //                         <label  for="department">Department</label>
      //                         <select class="form-control" id="dept_${value.level}" onchange ="onChangeSelectDept('dept_${value.level}', ${value.level})">
      //                         <option value disabled selected>{{ trans('global.pleaseSelect') }}</option>
      //                         `;
      //                         $.each(DepartmentList, (n,d) =>{
      //                             let selected = false;
      //                             if(value.category === "department" && member_ids.findIndex(b => b == d.id) > -1){
      //                                 selected = true;
      //                             }
      //                             deparmentCol +=  ` <option value="${d.id}"  ${selected== true? 'selected':''}>${d.department_name}</option>`;

      //                         });

      //                         deparmentCol+= ` </select>`;

      //     deparmentDiv.innerHTML = deparmentCol;
      //     row.appendChild(deparmentDiv);

          const HodDiv = document.createElement('div');
          HodDiv.className = "col-4 form-group";
          HodDiv.setAttribute('id', `hodpanel_${value.level}`);
          HodDiv.style.display = value.category == 'department'?'block': 'none';

      const HodCol= `
                              <labe> &nbsp;</label>
                              <label  class="form-control">HOD</label>

                          `
                          HodDiv.innerHTML = HodCol;
          row.appendChild(HodDiv);
      item.appendChild(row);
      list.appendChild(item);
  });
}

function MyUploadAdapterPlugin( editors ) {
  editors.plugins.get( 'FileRepository' ).createUploadAdapter = function( loader ) {
      // Custom upload adapter.
      // ...
  };
}
function addParater(){
  var para =  $('#parameterUserInput');
  const text =para.val();
  const viewFragment = editor.data.processor.toView(`{${text}}`);
  const modelFragment = editor.data.toModel(viewFragment);
  editor.model.insertContent(modelFragment, editor.model.document.selection);
  $('#parameterModal').modal('hide');
}
function addUserParameter(){
  $('#parameterModal').modal('show');
}


document.querySelector( '#editor' ).innerHTML="";
function InbuiltParameter(){
    let btnParm = ``;
    $.each(inbuiltParameter, (i, v) => {
        btnParm += `<a class="btn btn-info" style="color: white; margin-right: 5px; margin-top: 5px" onclick="addText('${v}')">${v}</a>`;
    });
    btnParm += `<a class="btn btn-info" style="color: white; margin-right: 5px; margin-top: 5px" onclick="addUserParameter()">User defined Parameter</a>`
    document.getElementById('parameter').innerHTML = btnParm;

}

function addText(text){
    const viewFragment = editor.data.processor.toView(`{${text}}`);
    const modelFragment = editor.data.toModel(viewFragment);
    editor.model.insertContent(modelFragment, editor.model.document.selection)
}
 $(document).ready(function () {
    window._token = $('#_token').val();
    GetMemberList();
    GetDepartmentList();
    InbuiltParameter();
    category = JSON.parse("{{ $category }}".replace(/&quot;/g,'"'))  ;

    // ClassicEditor.create(
    //         document.querySelector( '#editor' ), {
    //             ckfinder: {
    //             uploadUrl: "{{route('admin.image.upload').'?_token='.csrf_token()}}",
    //         },
    //         //plugins: [ 'Essentials', 'Autoformat', 'Bold', 'Italic', 'BlockQuote', 'Heading', 'Link', 'List', 'MediaEmbed', 'Paragraph', 'PasteFromOffice', 'Table', 'SourceEditing' ],
    //       //  toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|', 'table', 'mediaEmbed', '|', 'undo', 'redo', '|', 'sourceEditing' ],

    //        // extraPlugins: [MyUploadAdapterPlugin],//SimpleUploadAdapter

    //         list: {
    //             properties: {
    //                 styles: true,
    //                 startIndex: true,
    //                 reversed: true
    //             }
    //         },
    //         heading: {
    //             options: [
    //                 { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
    //                 { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
    //                 { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
    //                 { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
    //                 { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
    //                 { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
    //                 { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
    //             ]
    //         },
    //         fontFamily: {
    //             options: [
    //                 'default',
    //                 'Arial, Helvetica, sans-serif',
    //                 'Courier New, Courier, monospace',
    //                 'Georgia, serif',
    //                 'Lucida Sans Unicode, Lucida Grande, sans-serif',
    //                 'Tahoma, Geneva, sans-serif',
    //                 'Times New Roman, Times, serif',
    //                 'Trebuchet MS, Helvetica, sans-serif',
    //                 'Verdana, Geneva, sans-serif'
    //             ],
    //             supportAllValues: true
    //         },
    //         fontSize: {
    //             options: [ 10, 12, 14, 'default', 18, 20, 22 ],
    //             supportAllValues: true
    //         },
    //     }).then(res =>{
    //         // res.model.document.on('change:data', () => {

    //              editor = res;
    //         // });

    //     });


    const config = {
         toolbar: {
        items: [
            'undo', 'redo',
            '|', 'heading',
            '|', 'bold', 'italic',
            '|', 'link', 'uploadImage', 'insertTable', 'mediaEmbed',
            '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
        ]
    }};


    InlineEditor.create( document.querySelector( '#editor' ), config )
    .then( res => {
        editor = res;
        res.model.document.on('change:data', () => {

            editor = res;
        });
    } )
    .catch( err => {
        console.log( err );
    } );



//             RichTextEditorInit.RichTextEditor.Inject(RichTextEditorInit.Toolbar, RichTextEditorInit.Link, RichTextEditorInit.Image, RichTextEditorInit.HtmlEditor, RichTextEditorInit.QuickToolbar);

// let defaultRTE = new RichTextEditorInit.RichTextEditor({
//   height: 340,
//   quickToolbarSettings: {
// image: [
//   'Replace', 'Align', 'Caption', 'Remove', 'InsertLink', 'OpenImageLink', '-',
//   'EditImageLink', 'RemoveImageLink', 'Display', 'AltText', 'Dimension'
// ],
// link: ['Open', 'Edit', 'UnLink']
// },
//   toolbarSettings: {
//   items: ['Bold', 'Italic', 'Underline', 'StrikeThrough',
//     'FontName', 'FontSize', 'FontColor', 'BackgroundColor',
//     'LowerCase', 'UpperCase', '|',
//     'Formats', 'Alignments', 'OrderedList', 'UnorderedList',
//     'Outdent', 'Indent', '|',
//     'CreateLink', 'Image', '|', 'ClearFormat', 'Print',
//     'SourceCode', 'FullScreen', '|', 'Undo', 'Redo']
// }

// });
//defaultRTE.appendTo('#defaultRTE');

});
