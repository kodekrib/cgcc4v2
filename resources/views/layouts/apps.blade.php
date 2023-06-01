<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="language" content="English" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="Search_Engines" content="Google, MSN, Bing, Overture, AltaVista, Yahoo, AOL, Infoseek, LookSmart, Excite, Hotbot, Lycos, Magellan, CNET, DogPile, Ask Jeeves, Teoma, Snap, Webcrawler" />
<meta name="distribution" content="Global" />
<meta name="audience" content="all" />
<meta name="ROBOTS" content="INDEX, FOLLOW" />
<meta name="Robots" content="INDEX,ALL" />
<meta name="YahooSeeker" content="INDEX, FOLLOW" />
<meta name="msnbot" content="INDEX, FOLLOW" />
<meta name="googlebot" content="INDEX, FOLLOW" />
<meta name="allow-search" content="yes" />
<meta name="Generator" content="Macromedia Dreamweaver" />
<meta http-equiv="content-language" content="en-us" />
<meta name="author" content="CGCC Technology Group" />
<meta name="owner" content="tg@thecitadelglobal.org" />
<meta name="rating" content="general" />
<meta name="resource-type" content="web page" />
<meta name="copyright" content="(C) CGCC Technology Group" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<base href="{{  url('') }}/">
<link rel="ICON" type="image/gif" href="images/cgcc.gif" />
<title>{{ trans('panel.site_title') }}</title>
<link href="css/getdevice.css" rel="stylesheet" type="text/css" media="all" />
  @yield('styles')
</head>
<body>
	@yield("content")
	@yield('scripts')
</body>
</html>