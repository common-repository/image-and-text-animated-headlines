<?php
//Attach style and javascript
add_action('admin_enqueue_scripts', 'imtah_enqueue');
add_action('wp_enqueue_scripts', 'imtah_enqueue');

//Enqueue Styles and scripts
function imtah_enqueue() {
  wp_enqueue_script('imtahA1_script', plugins_url( 'js/animation1.js', __FILE__), array('jquery','media-upload'), 2017, true );
  //passing variables to the javascript file (cannot write php in the js file)
  wp_localize_script('imtahA1_script', 'frontEndAjaxA1', array(
  'ajaxurl' => admin_url( 'admin-ajax.php' ),
  'nonce' => wp_create_nonce('ajax_A1_img_nonce')
  ));
}

  ////register settings and sanitize
function imtah_animation1_register_settings()
{
  add_option( 'imtah_animation1_name', 'Name1');
  add_option( 'imtah_animation1_text1', 'THIS');
  add_option( 'imtah_animation1_text2', 'IS');
  add_option( 'imtah_animation1_text3', 'ANIMATION1');
  add_option( 'imtah_animation1_text4', 'TEXT AND IMAGE');
  add_option( 'imtah_animation1_image_attachment_id', '');
  add_option( 'imtah_animation1_text_color', '#000000');
  add_option( 'imtah_animation1_font', 'Impact');
  add_option( 'imtah_animation1_url', ''); 

  register_setting( 'imtah_settings', 'imtah_animation1_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_image_attachment_id', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation1_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 
}

add_action( 'admin_init', 'imtah_animation1_register_settings' );

//////////////////////////////////////////////////////////////////////

//Add shortcode
add_shortcode( 'imtah_animation1', 'imtah_disAnimation1' );

///////////////////////////////////////////////////////////////////
//Shortcode function for Html code for animation 1 front end output
function imtah_disAnimation1($attr)
{
  shortcode_atts( 
    array(
    'name'=> '', 
    'text1'=> '',
    'text2'=> '',
    'text3'=> '',
    'text4'=> '',
    'image'=> '',
    'font'=> '',
    'text_color'=> '',
    'url'=> ''
    ), $attr
  );
  $monadiki = imtah_inc_id();
  ob_start();//$monadiki = uniqid();//****, den paizei 
  ?><div onclick="<?php if($attr['url']!=""){echo "location.href="."'".esc_url($attr['url'])."'".'"';}?>" id=<?php echo ('"'.esc_html($attr['name']).esc_html($monadiki."Div1").'"');?>style="position:relative; <?php if($attr['url']!=""){echo "display: block; cursor: pointer;";} ?>">
  <canvas id=<?php echo ('"'.esc_html($attr['name'])."A11".esc_html($monadiki).'"'); ?>width="600" height="200" 
  style="position: relative;"></canvas>

  <canvas id=<?php echo ('"'.esc_html($attr['name'])."A12".esc_html($monadiki).'"'); ?>width="600" height="200" 
  style="position: absolute; left: 0; top: 0; "></canvas>

  <canvas id=<?php echo ('"'.esc_html($attr['name'])."A13".esc_html($monadiki).'"'); ?>width="600" height="200" 
  style="position: absolute; left: 0; top: 0; "></canvas> 
  </div>

  <script>

    function Imtah_animation1Run(){

      var canvas=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A11".esc_html($monadiki).'"'); ?>);
      var ctx=canvas.getContext("2d");
      var canvas2=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A12".esc_html($monadiki).'"'); ?>);
      var ctx2=canvas2.getContext("2d");
      var canvas3=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A13".esc_html($monadiki).'"'); ?>);
      var ctx3=canvas3.getContext("2d");
      w = canvas.width;
      h = canvas.height;



      function resize() { 
        var clientWidth=<?php echo (esc_html($attr['name']).esc_html($monadiki)."Div1");?>.parentElement.getBoundingClientRect().width;
        var width = clientWidth;
        var ratio = 3;
        var height = width / ratio;

        canvas.style.width = width+"px"; 
        canvas.style.height = height+"px";    
        canvas2.style.width = width+"px";  
        canvas2.style.height = height+"px";
        canvas3.style.width = width+"px";
        canvas3.style.height = height+"px"; 

      } 

      window.addEventListener("load", resize, false); 
      window.addEventListener("resize", resize, false);  


      var img1 = new Image();        
      img1.src =<?php echo ('"'.wp_get_attachment_url (esc_html($attr['image'])).'"'); ?>;
      var speed=0;   
      var i=0;  
      var inc=0;
      var bounce = 0;
      var dir =0;
      var font=<?php echo ('"'.esc_html($attr['font']).'"'); ?>;
      var txt1=<?php echo ('"'.esc_html($attr['text1']).'"'); ?>;
      var txt2=<?php echo ('"'.esc_html($attr['text2']).'"'); ?>; 
      var txt3=<?php echo ('"'.esc_html($attr['text3']).'"'); ?>; 
      var txt4=<?php echo ('"'.esc_html($attr['text4']).'"'); ?>;
      var txtPos = 0;
      var txt1Pos = 0;
      var txt2Pos = 0;
      var txt3Pos = 0; 
      var bounce = 0;
      var dir = 0;
      var vx = 0;  
      var type = 0;
      var imgWidth= w/2; 
      var fontsize=h/4.5; 


      function TypeWriter(txt) {
        this.iTxt=0;
        this.text="";

        this.update=function()
        {
            if (this.iTxt < txt.length) {
            this.text += txt.charAt(this.iTxt);
            this.iTxt++;
            return this.text; 
          }
            else
          {
            this.text=txt;
            return this.text;
          }
        }
      }

      function UpdatePositivePosition(text,x,y,vx,posAcceleration,negAcceleration,friction){
        this.txtPos=x;
        this.acc=posAcceleration;
        this.negAcc=negAcceleration;
        this.txt=text;
        this.y=y;
        this.vx=vx;
        this.fric= 1;
        this.bounce=0;
        this.dir=0; 

        this.update = function()
        {
          if ((this.txtPos > w/2) && this.dir == 0)     
          {
            this.bounce++;
            this.dir=1; 
          }
          if ((this.txtPos < w/2) && this.dir == 1) 
          {
            this.bounce++;
            this.dir=0;
          }

          this.fric=1-this.bounce * 0.2; 

          if (this.txtPos<w/2) 
          {
            this.vx += this.acc;
          }
          else 
          {
            this.vx -= this.negAcc; 
          } 

          this.vx *= this.fric;  
          this.txtPos += this.vx;  
          ctx.font = ""+"bolder "+fontsize+"px "+font+"";
          ctx.fillStyle =<?php echo ('"'.esc_html($attr['text_color']).'"'); ?>;
          ctx.fillText(this.txt,this.txtPos,this.y); 
          return [this.txtPos,this.bounce];
      } 


      //      
      }
      //////////////////////////////////////////////display on visibility ////////////////////////////////////

      function reveal()
      {
        var element = document.getElementById(<?php echo ('"'.$attr['name']."A13".$monadiki.'"');?>);
        var offsetParentTop = 0;

        if(!isNaN(element.offsetTop))
        {
          offsetParentTop += element.offsetTop;
        }

        var pageYOffset = window.pageYOffset;
        var viewportHeight = window.innerHeight;
        var distanceToTop = element.getBoundingClientRect().top;
        var height=element.offsetHeight;
        var scrollY=window.scrollY;

        if((distanceToTop + height +pageYOffset )  < (scrollY + viewportHeight))
        {
          return true;
        }

      }

      window.addEventListener("load", reveal, false); 
      window.addEventListener("resize", reveal, false);
      window.addEventListener("scroll", reveal, false);

      var t1pos = new UpdatePositivePosition(txt1,-500,h/4,0,4,11,2);  
      var t2pos = new UpdatePositivePosition(txt2,-500,h/2,0,4,11,2);     
      var t3pos = new UpdatePositivePosition(txt3,-500,h/1.33,0,4,11,2);                         
      var text = new TypeWriter(txt4);
      var text1=text.update();
      var loop;

      function animloop()  
      { 
      loop=requestAnimationFrame(animloop);   
      ctx.clearRect(0, 0, w, h); 
      ctx2.clearRect(0, 0, w, h);     
      ctx3.clearRect(0,0,w,h);

      switch(i)  
      {  
        case 0:
          resize();

          if (true)
          {
            if (reveal() && i==0 )
            {
              setTimeout(function ()
              {
                if (i==0)
                {
                  i=2;
                }
              },400); 
            }
          } 
          else 
          {
            i=60;
          } 

        break;


        case 2:
          if (<?php echo ('"'.$attr['image'].'"'); ?>!='')
          {
            
            var pos1=t1pos.update();   
            if (pos1[1]>3){i=10};
            if (txt1==''){i=10};
            break;   
          }

          else
          {
            ctx.font = "20px Arial"; 
            ctx.fillText("No image please choose image",0,100);
        break;  
        }

        case 10:
          t1pos.update();
          var pos2=t2pos.update(); 
          if (pos2[1]>3){i=20};
          if (txt2==''){i=20};     
        break;  

        case 20:
          t1pos.update(); 
          t2pos.update();
          var pos3=t3pos.update();
          if (pos3[1]>4){i=30};
          if (txt3==''){i=30};
        break;  

        case 30:
          
          ctx.fillText(txt1,w/2,h/4);
          ctx.fillText(txt2,w/2,h/2);
          ctx.fillText(txt3,w/2,h/1.33);  
          ctx2.filter="opacity("+inc*2+"%)";
          ctx2.drawImage(img1, 0, 0,w/2-w/20,h); 

        if (inc > 30 && txt4 !='') {
          ctx3.filter="opacity("+(inc-30)+"%)";  
          ctx3.fillRect(0,h-h/4,w/2-w/20,w)   
        }  

        inc++;
        if (inc>80)
        { 
          i=40;
          inc=0;
        } 
        break; 

        case 40:
          inc++;

          ctx.fillText(txt1,w/2,h/4);
          ctx.fillText(txt2,w/2,h/2);
          ctx.fillText(txt3,w/2,h/1.33);
          ctx2.filter="opacity("+100+"%)";
          ctx2.drawImage(img1, 0, 0,w/2-w/20,h);

        if (txt4!='')
        {
          ctx3.filter="opacity("+(50)+"%)"; 
          ctx3.fillStyle = "black";
          ctx3.fillRect(0,h-h/4,w/2-w/20,w); 
          ctx3.filter="opacity("+(80)+"%)";  
          ctx3.font = ""+(h/10)+"px "+font+"";   
          ctx3.fillStyle = "white";     
          ctx3.fillText(text1,w/40,h/1.1);
        }
        if(inc>type)  
        {
          text1=text.update()
          type+=4;
        }
        if(text1.length==txt4.length)
        {
          i=50
          inc=0;
        }
        break; 

        case 50:

          ctx.fillText(txt1,w/2,h/4); 
          ctx.fillText(txt2,w/2,h/2);
          ctx.fillText(txt3,w/2,h/1.33);
          ctx2.filter="opacity("+100+"%)";
          ctx2.drawImage(img1, 0, 0,w/2-w/20,h); 

          if (txt4!='')
          {
            ctx3.filter="opacity("+(50)+"%)"; 
            ctx3.fillStyle = "black";  
            ctx3.fillRect(0,h-h/4,w/2-w/20,w); 
            ctx3.filter="opacity("+(80)+"%)";    
            ctx3.fillStyle = "white";      
            ctx3.fillText(text1,w/40,h/1.1);
          } 
          cancelAnimationFrame(loop);
        break;

      }

      }

      animloop(); 

    }

    Imtah_animation1Run();

  </script><?php
  $output = ob_get_clean();
  return $output;
}

//Shortcode function for calling animation1 with select shortcut
add_shortcode( 'canvasanimation1', 'imtah_shortcutForAnim1' );

function imtah_shortcutForAnim1( $attr ) {
// Configure defaults and extract the attributes into variables
  shortcode_atts( 
    array(
      'attributes'=> '',
    ), $attr
  );

  global $wpdb;
  $myQuery = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation1Table WHERE name ='{$attr['attributes']}'");
  $MyShortcode= do_shortcode('[imtah_animation1 name="'.$myQuery->name.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image="' .$myQuery->imagepath.'" font="' .$myQuery->textFont.'" text_color="'.$myQuery->textColor.'" url="'.$myQuery->url.'"]');
  ob_start(); 
  echo $MyShortcode;
  return ob_get_clean();  
}

    //////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////    

    ///Code for admin html output at animaton 1 settings/admin page

function imtah_display_animation1_html()
{   
  ?><div style="float:right; margin-top:10%; margin-right:5%; width:60%"><?php
  $abTime='[imtah_animation1 name="'.get_option( 'imtah_animation1_name' ).'" text1="'.get_option( 'imtah_animation1_text1' ).'" text2="'.get_option( 'imtah_animation1_text2' ).'" text3="'.get_option( 'imtah_animation1_text3' ).'" text4="'.get_option( 'imtah_animation1_text4' ).'" image="'.get_option( 'imtah_animation1_image_attachment_id' ).'" font="'.get_option( 'imtah_animation1_font' ).'" text_color="'.get_option( 'imtah_animation1_text_color' ).'" url="'.get_option( 'imtah_animation1_url' ).'"]';
  echo do_shortcode($abTime);
  ?></div>
  <div style="float:left; margin-top:5%; width:20%;">
  <h2>Animation1 settings</h2>

  <form method="post"  action="<?php echo esc_html(admin_url('admin-ajax.php')); ?>" id="A1form" >
    <?php wp_nonce_field('imtah_A1add_transfer','imtah_A1update_security_nonce'); ?>
    <input name="action" value="imtah_A1add_transfer" type="hidden"> 
    <table width="100%" cellpadding="10"  style="border:2px solid">
      <tr>
        <td align="left" scope="row">
          <label>Animation Name:<?php echo esc_html(get_option( 'imtah_animation1_name' )); ?></label>
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Text font:</label>
          <select name="imtah_animation1_font">
            <option style="display:none" ><?php echo esc_html(get_option( 'imtah_animation1_font' ));?></option>
            <option value="Impact">Impact</option>
            <option value="Arial">Arial</option>
            <option value="Helvetica">Helvetica</option>
            <option value="Futura">Futura</option> 
            <option value="Bodoni">Bodoni</option>
          </select>
      </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
        <!-- color picker -->
          <label style="margin-right:5px; padding-bottom:15px;">Text color</label><input type="text" name="imtah_animation1_text_color" value="<?php echo esc_html(get_option( 'imtah_animation1_text_color' )); ?>" class="my-color-field" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Text1</label><input type="text" name="imtah_animation1_text1" 
          value="<?php echo esc_html(get_option( 'imtah_animation1_text1' )); ?>" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Text2</label><input type="text" name="imtah_animation1_text2" 
          value="<?php  echo esc_html(get_option( 'imtah_animation1_text2' )); ?>" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Text3</label><input type="text" name="imtah_animation1_text3" 
          value="<?php  echo esc_html(get_option( 'imtah_animation1_text3' )); ?>" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Text4</label><input type="text" name="imtah_animation1_text4" 
          value="<?php  echo esc_html(get_option( 'imtah_animation1_text4' )); ?>" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <label>Url</label><input type="text" name="imtah_animation1_url" 
          value="<?php  echo esc_url(get_option( 'imtah_animation1_url' )); ?>" />
        </td> 
      </tr>

      <tr>
        <td align="left" scope="row">
          <p>Headline image</p>
          <img id='imtah_animation1_image-preview' src='<?php echo esc_html(wp_get_attachment_url( get_option( 'imtah_animation1_image_attachment_id' ) )); ?>' height='100'>
          <br>
          <input id="imtah_animation1_upload_image_button" type="button" class="button" value= "Upload image" />
        </td> 
      </tr>

    </table>

    <p class="submit">

      <input type="hidden" name="A1saveAs" id="A1inputForSaveAs"/>
      <input type="hidden" name="A1update" id="A1inputForUpdate"/>
      <input type="hidden" name="A1save" id="A1inputForSave"/>
      <input type="hidden" name="imtah_animation1_name" id="A1NameInput" value='<?php echo esc_html(get_option( 'imtah_animation1_name' )); ?>' />
      <input type='hidden' name='imtah_animation1_image_attachment_id' id='imtah_animation1_image_attachment_id' value='<?php echo esc_html(get_option( 'imtah_animation1_image_attachment_id' )); ?>'/>
      <input type="hidden" name="page_options" value="imtah_animation1_name, imtah_animation1_text1, imtah_animation1_text2, imtah_animation1_text3, imtah_animation1_text4, imtah_animation1_font, imtah_animation1_image_attachment_id, imtah_animation1_text_color, imtah_animation1_url" /> 
      <button type="button" id="A1UpdateButton">Update </button>
      <button type="button" id="A1SaveButton">Save </button>
      <button type="button" id="A1SaveAsButton">Save as </button>

    </p>

  </form>

  <script>

    (function($){

    $(document).ready(function()
    {
      //////////////////Save As button//////////////////////////////////
      $( "#A1SaveAsButton" ).click(function() {

        var newname = prompt("Please input a name: ");
        if(!newname) return;
        $('#A1NameInput').val(newname);
        $('#A1inputForSaveAs').val("yes");

        var data = {
          'action': 'imtah_A1my_action',
          'security': '<?php echo wp_create_nonce( "ajax-nonce-A1" ); ?>',
          'name': newname
        };

        jQuery.post(ajaxurl, data, function(response) {

          if(response=='nameExists') 
          {
            alert(newname +''+ ' already exists');
          }
          
          else if(response=='firstIsNumeric')
          {
            alert(newname +''+ ' illegal, first letter is number');
          }

          else if(response=='OK')
          {
            $('#A1form').submit();
          }
        });

      });

        //////////////////Save button//////////////////////////////////
        $( "#A1SaveButton" ).click(function() {

          var newdirname1 =<?php echo ('"'.esc_html(get_option( 'imtah_animation1_name' ))).'"'; ?>;
          if(!newdirname1) return;
          $('#A1NameInput').val(newdirname1);
          $('#A1inputForSave').val("yes");
          $('#A1form').submit();
          alert("save " + newdirname1 + "?");     
        });

        //////////////////Update button//////////////////////////////////
        $( "#A1UpdateButton" ).click(function() {
          $('#A1inputForUpdate').val("yes");
          $('#A1form').submit();   
        });

      });
    }(jQuery));//This is for replacing JQuery with $

  </script>

  </div><?php
  ////////////////////////Create an instance of our package class...DISPLAY TABLE
  $imtah_testListTable = new imtah_ItemsAnimation1_List_Table();
  //Fetch, prepare, sort, and filter our data...
  $imtah_testListTable->prepare_items();
  ?><div style="clear: both; padding-top: 10px;">

    <h2>Animation1 recipe list table</h2>
      <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
      <form id="Items-filter" method="get">
        <!-- For plugins, we also need to ensure that the form posts back to our current page -->
        <input type="hidden" name="page" value="<?php echo esc_html($_REQUEST['page']) ?>" />
        <!-- Now we can render the completed list table --><?php $imtah_testListTable->display()
        ?></form> 

  </div><?php

}  
////////////////////////////////////////// END OF FUNCTION display_animation1_html


//////Handle form submission inside a function////////////////////////
add_action('wp_ajax_imtah_A1add_transfer', 'imtah_A1process_add_transfer');

function imtah_A1process_add_transfer() {
if ( empty($_POST) || !wp_verify_nonce($_POST['imtah_A1update_security_nonce'],'imtah_A1add_transfer') || !current_user_can('manage_options' ) ) 
  {
    echo 'You targeted the right function, but sorry, your did not verify.';
    die();
  } 
  else 
  {
     if ( $_POST['A1saveAs']=='yes' )
      {
        imtah_A1saveas();
        imtah_A1update();    
      }
    else if ( $_POST['A1save']=='yes' )
      {
        imtah_A1save();
        imtah_A1update();    
      }
    else if ( $_POST['A1update']=='yes' )
      {
        imtah_A1update();    
      }  
     wp_redirect(wp_get_referer());exit;
    
  }
}

// SaveAS VALUES TO NEW ROW /////
function imtah_A1saveas(){

    global $wpdb;
    //insert values to a new row
    $wpdb->insert($wpdb->prefix.'imtah_animation1Table',
  array(
    'name' => sanitize_text_field($_POST['imtah_animation1_name']) , 
    'text1' => sanitize_text_field($_POST['imtah_animation1_text1']) ,
    'text2' => sanitize_text_field($_POST['imtah_animation1_text2']) ,
    'text3' => sanitize_text_field($_POST['imtah_animation1_text3']) ,
    'text4' => sanitize_text_field($_POST['imtah_animation1_text4']) ,
    'textFont' => sanitize_text_field($_POST['imtah_animation1_font']) ,
    'textColor' => sanitize_text_field($_POST['imtah_animation1_text_color']) ,
    'url' => sanitize_text_field($_POST['imtah_animation1_url']) ,
    'Imagepath' =>  get_option( 'imtah_animation1_image_attachment_id' )
  ), 
  array( 
    '%s',
    '%s',
    '%s', 
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s'  
  )  );

}

// Save VALUES TO NEW ROW /////
function imtah_A1save(){

  global $wpdb;
  $myName=get_option( 'imtah_animation1_name' );
  $myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation1Table WHERE name = '$myName'");
  //insert values to a new row
  $wpdb->replace($wpdb->prefix.'imtah_animation1Table',
  array(
    'id'=> $myId,
    'name' => sanitize_text_field($_POST['imtah_animation1_name']) , 
    'text1' => sanitize_text_field($_POST['imtah_animation1_text1']) ,
    'text2' => sanitize_text_field($_POST['imtah_animation1_text2']) ,
    'text3' => sanitize_text_field($_POST['imtah_animation1_text3']) ,
    'text4' => sanitize_text_field($_POST['imtah_animation1_text4']) ,
    'textFont' => sanitize_text_field($_POST['imtah_animation1_font']) ,
    'textColor' => sanitize_text_field($_POST['imtah_animation1_text_color']) ,
    'url' => sanitize_text_field($_POST['imtah_animation1_url']) ,
    'Imagepath' =>  get_option( 'imtah_animation1_image_attachment_id' )  
  ), 
  array( 
    '%d',
    '%s',
    '%s',
    '%s', 
    '%s',
    '%s',
    '%s',
    '%s',
    '%s',
    '%s'  
  )  );
}

// Just update values
function imtah_A1update(){

  update_option( 'imtah_animation1_name', sanitize_text_field($_POST['imtah_animation1_name']));
  update_option( 'imtah_animation1_text1', sanitize_text_field($_POST['imtah_animation1_text1']));
  update_option( 'imtah_animation1_text2', sanitize_text_field($_POST['imtah_animation1_text2']));
  update_option( 'imtah_animation1_text3', sanitize_text_field($_POST['imtah_animation1_text3']));
  update_option( 'imtah_animation1_text4', sanitize_text_field($_POST['imtah_animation1_text4']));
  update_option( 'imtah_animation1_text_color', sanitize_text_field($_POST['imtah_animation1_text_color']));
  update_option( 'imtah_animation1_font', sanitize_text_field($_POST['imtah_animation1_font']));
  update_option( 'imtah_animation1_url', sanitize_text_field($_POST['imtah_animation1_url'])); 

}
//////////////////////////////////////////////////////////////////////

add_action('wp_ajax_imtah_A1my_action', 'imtah_A1my_action');
add_action('wp_ajax_imtah_A1update_picture', 'imtah_A1update_picture');

// FUNCTION FOR CHECKING IF NAME ALREADY EXISTS
function imtah_A1my_action()
{
  global $wpdb; // this is how you get access to the database
  $name = sanitize_text_field($_POST['name']);
  // security check
  check_ajax_referer( 'ajax-nonce-A1', 'security' );

  if (imtah_A1IsNameExists($name)=="yes")
    {
      $result='nameExists';
    }
  else if (is_numeric(substr($name, 0, 1)))
    {
      $result='firstIsNumeric';
    }
  else 
    {
      $result='OK'; 
    }  
  echo $result;
  die(); // this is required to terminate immediately and return a proper response

}

//function for checking if name already exists
function imtah_A1IsNameExists($checkName){

  global $wpdb;
  $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation1Table");

  foreach ( $result as $value ) {
    if ($value->name == $checkName){
      return 'yes';   
    }
  }
}

//Function for updating image option on wp.media upload
function imtah_A1update_picture(){
  $imageId = sanitize_text_field($_POST['imageId']);
  check_ajax_referer( 'ajax_A1_img_nonce', 'security' );
   if ($imageId)
   {
     update_option( 'imtah_animation1_image_attachment_id', $imageId );
   }
  die();
}

//Function for updating values from table
function imtah_A1update_from_table($id){
  global $wpdb;
  $mylink = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation1Table WHERE id =".$id);
  update_option( 'imtah_animation1_name', $mylink->name);
  update_option( 'imtah_animation1_text1', $mylink->text1);
  update_option( 'imtah_animation1_text2', $mylink->text2);
  update_option( 'imtah_animation1_text3', $mylink->text3);
  update_option( 'imtah_animation1_text4', $mylink->text4);
  update_option( 'imtah_animation1_image_attachment_id', $mylink->imagepath);
  update_option( 'imtah_animation1_text_color', $mylink->textColor);
  update_option( 'imtah_animation1_font', $mylink->textFont);
  update_option( 'imtah_animation1_url', $mylink->url);  
}

//Delete option if deleted row == current options
function imtah_A1del_options(){
  global $wpdb;
  $myName=get_option( 'imtah_animation1_name' );
  $myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation1Table WHERE name = '$myName'");//If it has been deleted it will be null
  if (is_null($myId)) 
  {   
    update_option( 'imtah_animation1_name', "");
    update_option( 'imtah_animation1_text1', "");
    update_option( 'imtah_animation1_text2', "");
    update_option( 'imtah_animation1_text3', "");
    update_option( 'imtah_animation1_text4', "");
    update_option( 'imtah_animation1_image_attachment_id', "");
    update_option( 'imtah_animation1_text_color', "");
    update_option( 'imtah_animation1_font', "");
    update_option( 'imtah_animation1_url', ""); 
     
  } 
}

///////////////////Code for WP_list_table/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

if(!class_exists('WP_List_Table')){
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class imtah_ItemsAnimation1_List_Table extends WP_List_Table {

//Get data from table
function get_items() {

  global $wpdb;
  $sql = "SELECT * FROM " . $wpdb->prefix . 'imtah_animation1Table';
  $result = $wpdb->get_results( $sql, 'ARRAY_A' );
  return $result;
}

function __construct(){
  global $status, $page;
  //Set parent defaults
  parent::__construct( array(
  'singular'  => 'ABitem',     //singular name of the listed records
  'plural'    => 'ABitems',    //plural name of the listed records
  'ajax'      => false        //does this table support ajax?
  ) );
}

function delete_item( $id ) {
  global $wpdb;
  $wpdb->delete(
  "{$wpdb->prefix}imtah_animation1Table",
  [ 'id' => $id ],
  [ '%d' ]
  );
}


function column_default($item, $column_name){
  switch($column_name){
    case 'text1':
    case 'text2':
    case 'text3':
    case 'text4':
    case 'textFont':
    case 'textColor':
    case 'url':
    case 'imagepath':


    return $item[$column_name];
    default:
    return print_r($item,true); //Show the whole array for troubleshooting purposes
  }
}
function column_name($item){

  // create a nonce
  $edit_nonce = wp_create_nonce( 'imtah_A1edit_item' );
  $delete_nonce = wp_create_nonce( 'imtah_A1delete_item' );

  //Build row actions
  $item_json = json_decode(json_encode($item), true);
  $actions = array(
  'edit'   => sprintf('<a href="?page=%s&action=%s&ABitem=%s&_wpnonce=%s">Edit</a>',$_REQUEST['page'],'edit',$item['id'],$edit_nonce),
  'delete' => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id'],$delete_nonce)
  );

  //Return the title contents
  return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
  /*$1%s*/ $item['name'],
  /*$2%s*/ $item['id'],
  /*$3%s*/ $this->row_actions($actions)
  );
}

function column_cb($item){
  return sprintf(
  '<input type="checkbox" name="id[]" value="%s" />',
  $item['id']
  );
}


function get_columns(){
  $columns = array(
    'cb'     => '<input type="checkbox" />', //Render a checkbox instead of text
    'name'   => 'Name',
    'text1'   => 'Text1',
    'text2'   => 'Text2',
    'text3'   => 'Text3',
    'text4'   => 'Text4',
    'textFont'   => 'Text font',
    'textColor'   => 'Text color',
    'url'   => 'url link',
    'imagepath'  => 'Image id'

  );
  return $columns;
}

function get_sortable_columns() {
  $sortable_columns = array(
    'name'     => array('Name',false),//true means it's already sorted
  );
  return $sortable_columns;
}

function get_bulk_actions() {
  $actions = array(
    'bulk-delete'    => 'Delete'
  );
  return $actions;
}

function process_bulk_action() {

  //Detect when a delete action is being triggered...
  if ( 'delete' === $this->current_action() ) 
  {
    // In our file that handles the request, verify the nonce.
    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
    if ( wp_verify_nonce( $nonce, 'imtah_A1delete_item' ) ) 
    {
      self::delete_item( absint( $_GET['id'] ) );
      imtah_A1del_options();
      wp_redirect(wp_get_referer());
      exit;
    }

  }

  // If the delete bulk action is triggered
  if ( 'bulk-delete' === $this->current_action() ) 
  {
    // loop over the array of record IDs and delete them
    foreach ($_GET['id'] as $id ) {
      $SanitizedId=sanitize_text_field( $id );
      self::delete_item( $SanitizedId );
      imtah_A1del_options();
    }
    wp_redirect(wp_get_referer());
    exit;
  }

  //if edit action is triggered
  if('edit'==$this->current_action())
  {
    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
    if ( wp_verify_nonce( $nonce, 'imtah_A1edit_item' ) ) 
    {
      imtah_A1update_from_table(absint( $_GET['ABitem'] ));
      wp_redirect(wp_get_referer());
      exit;
    }
    
  }

}

function prepare_items() 
{
  global $wpdb; //This is used only if making any database queries

  /**
  * First, lets decide how many records per page to show
  */
  $per_page = 5;


  /**
  * REQUIRED. Now we need to define our column headers. This includes a complete
  * array of columns to be displayed (slugs & titles), a list of columns
  * to keep hidden, and a list of columns that are sortable. Each of these
  * can be defined in another method (as we've done here) before being
  * used to build the value for our _column_headers property.
  */
  $columns = $this->get_columns();
  $hidden = array();
  $sortable = $this->get_sortable_columns();

  /**
  * REQUIRED. Finally, we build an array to be used by the class for column 
  * headers. The $this->_column_headers property takes an array which contains
  * 3 other arrays. One for all columns, one for hidden columns, and one
  * for sortable columns.
  */
  $this->_column_headers = array($columns, $hidden, $sortable);

  /**
  * Optional. You can handle your bulk actions however you see fit. In this
  * case, we'll handle them within our package just to keep things clean.
  */
  $this->process_bulk_action();

  /**
  * Instead of querying a database, we're going to fetch the example data
  * property we created for use in this plugin. This makes this example 
  * package slightly different than one you might build on your own. In 
  * this example, we'll be using array manipulation to sort and paginate 
  * our data. In a real-world implementation, you will probably want to 
  * use sort and pagination data to build a custom query instead, as you'll
  * be able to use your precisely-queried data immediately.
  */
  $data = $this->get_items();

  /**
  * This checks for sorting input and sorts the data in our array accordingly.
  * 
  * In a real-world situation involving a database, you would probably want 
  * to handle sorting by passing the 'orderby' and 'order' values directly 
  * to a custom query. The returned data will be pre-sorted, and this array
  * sorting technique would be unnecessary.
  */
  function usort_reorder($a,$b)
  {
    $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
    $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
    $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
    return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
  }
  usort($data, 'usort_reorder');


  /***********************************************************************
  * ---------------------------------------------------------------------
  * vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv
  * 
  * In a real-world situation, this is where you would place your query.
  *
  * For information on making queries in WordPress, see this Codex entry:
  * http://codex.wordpress.org/Class_Reference/wpdb
  * 
  * ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
  * ---------------------------------------------------------------------
  **********************************************************************/


  /**
  * REQUIRED for pagination. Let's figure out what page the user is currently 
  * looking at. We'll need this later, so you should always include it in 
  * your own package classes.
  */
  $current_page = $this->get_pagenum();

  /**
  * REQUIRED for pagination. Let's check how many items are in our data array. 
  * In real-world use, this would be the total number of items in your database, 
  * without filtering. We'll need this later, so you should always include it 
  * in your own package classes.
  */
  $total_items = count($data);


  /**
  * The WP_List_Table class does not handle pagination for us, so we need
  * to ensure that the data is trimmed to only the current page. We can use
  * array_slice() to 
  */
  $data = array_slice($data,(($current_page-1)*$per_page),$per_page);


  /**
  * REQUIRED. Now we can add our *sorted* data to the items property, where 
  * it can be used by the rest of the class.
  */
  $this->items = $data;

  /**
  * REQUIRED. We also have to register our pagination options & calculations.
  */
  $this->set_pagination_args( array(
    'total_items' => $total_items,                  //WE have to calculate the total number of items
    'per_page'    => $per_page,                     //WE have to determine how many items to show on a page
    'total_pages' => ceil($total_items/$per_page)   //WE have to calculate the total number of pages
  ) );
}
}
?>