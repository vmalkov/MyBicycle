<script src="js/tinymce/jquery.tinymce.min.js"></script>
			<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
			  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
			 
<script>
	jQuery(document).ready(function($){
		$("<a href=\"javascript:;\">__on/__off</a>").addClass("toggle").insertAfter($("textarea[name=\"<?=$textarea_name;?>\"]"));
		
		
		$("a.toggle").toggle(function(){
           tinyMCE.activeEditor.hide();
        }, function () {
            tinyMCE.activeEditor.show();
        });
		var d = new Date();
		$( "div.posts-date input" ).datepicker({
			dateFormat: "dd.mm.yy " + d.getHours() +":"+ d.getMinutes()
		});
	});

$("textarea[name=\"<?=$textarea_name;?>\"]").tinymce({
      script_url : "<?=$base;?>/js/tinymce/tinymce.min.js",
          theme : "modern",
          menubar: false,
          height:280,
          width:"99%",
          language: "ru",
          toolbar: "insertfile undo redo | fontselect fontsizeselect styleselect | bold italic strikethrough underline superscript subscript | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link unlink image media | forecolor backcolor emoticons | code preview print fullscreen ", 
          plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor"],
         style_formats: [
        {title: "Заголовок H1", block: "h1"},
        {title: "Заголовок H2", block: "h2"},
        {title: "Заголовок H3", block: "h3"},
        {title: "Заголовок H4", block: "h4"},
        {title: "Заголовок H5", block: "h5"},
        {title: "<pre>", block: "pre"},
        {title: "<code>", block: "code"},
        {title: "<span>", inline: "span", styles:{}},
        {title: "<div>", block: "div"}
    ],
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 60pt 72pt",
    codemirror: {
    indentOnInit: true, // Whether or not to indent code on init. 
    path: "codemirror", // Path to CodeMirror distribution
    config: {           // CodeMirror config object
       mode: "application/x-httpd-php",
       lineNumbers: true
    },
    jsFiles: [          // Additional JS files to load
       "mode/clike/clike.js",
       "mode/php/php.js"
    ]
  },
            file_browser_callback: RoxyFileBrowser
    });
    function RoxyFileBrowser(field_name, url, type, win) {
      var roxyFileman = "/fileman";
      if (roxyFileman.indexOf("?") < 0) {     
        roxyFileman += "?type=" + type;   
      }
      else {
        roxyFileman += "&type=" + type;
      }
      roxyFileman += "&input=" + field_name + "&value=" + document.getElementById(field_name).value;
      tinyMCE.activeEditor.windowManager.open({
         file: roxyFileman,
         title: "Roxy Fileman",
         width: 850, 
         height: 650,
         resizable: "yes",
         plugins: "media",
         inline: "yes",
         close_previous: "no"  
      }, {     window: win,     input: field_name    });
      return false; 
    }
	
</script>