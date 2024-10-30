<?php
//Attach style and javascript

add_action('admin_enqueue_scripts', 'imtah_Enqueue2');
add_action('wp_enqueue_scripts', 'imtah_Enqueue2');


//Enqueue Styles and scripts
function imtah_Enqueue2() {
  wp_enqueue_script('imtahA2_script', plugins_url( 'js/animation2.js', __FILE__), array('jquery','media-upload'), 2017, true );
  //passing variables to the javascript file (cannot write php in the js file)
  wp_localize_script('imtahA2_script', 'frontEndAjaxA2', array(
  'ajaxurl' => admin_url( 'admin-ajax.php' ),
  'nonce' => wp_create_nonce('ajax_A2_img_nonce')
  ));
}

 ////register settings and sanitize
function imtah_animation2_register_settings()
{
  add_option( 'imtah_animation2_name', 'Name1');
  add_option( 'imtah_animation2_text1', 'THIS');
  add_option( 'imtah_animation2_text2', 'IS');
  add_option( 'imtah_animation2_text3', 'ANIMATION2');
  add_option( 'imtah_animation2_text4', 'TEXT AND IMAGE');
  add_option( 'imtah_animation2_image_attachment_id1', '');
  add_option( 'imtah_animation2_image_attachment_id2', '');
  add_option( 'imtah_animation2_text_color', '#000000');
  add_option( 'imtah_animation2_font', 'Impact');
  add_option( 'imtah_animation2_url', ''); 

  register_setting( 'imtah_settings', 'imtah_animation2_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_image_attachment_id1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_image_attachment_id2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation2_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 
}

add_action( 'admin_init', 'imtah_animation2_register_settings' );

////////////////////////////////////////////////////////////////////
//Shortcode function for calling animation1 with select shortcut
add_shortcode( 'canvasanimation2', 'imtah_my_shortcutForAnim2' );

function imtah_my_shortcutForAnim2( $attr ) {

  // Configure defaults and extract the attributes into variables
  shortcode_atts( 
    array(
    'attributes'=> '',
    ), $attr
  );

  global $wpdb;
  $myQuery = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation2Table WHERE name ='{$attr['attributes']}'");

  $MyShortcode = do_shortcode('[imtah_animation2 name="'.$myQuery->name.'" text_color="'.$myQuery->textColor.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image1="' .$myQuery->imagepath1.'" image2="' .$myQuery->imagepath2.'" url="' .$myQuery->url.'" font="' .$myQuery->textFont.'"]');
  ob_start();
  echo $MyShortcode;
  return ob_get_clean();    
}

//Add shortcode
add_shortcode( 'imtah_animation2', 'imtah_disAnimation2' );

///////////////////////////////////////////////////////////////////
//Shortcode function for Html code for animation 1 front end output
function imtah_disAnimation2($attr){

  shortcode_atts( 
    array(
    'name'=> '', 
    'text_color'=> '',
    'font'=> '',
    'text1'=> '',
    'text2'=> '',
    'text3'=> '',
    'text4'=> '',
    'image1'=> '',
    'image2'=> '',
    'url'=> ''
    ), $attr
  );
  $monadiki = imtah_inc_id();
  ob_start();
  ?>
  <div onclick="<?php if($attr['url']!=""){echo "location.href="."'".esc_url($attr['url'])."'".'"';}?>" id= <?php echo ('"'.esc_html($attr['name']).esc_html($monadiki)."Div2".'"'); ?> style="position: relative;  <?php if($attr['url']!=""){echo "display: block; cursor: pointer;";} ?> ">
    <canvas id=<?php echo ('"'.esc_html($attr['name'])."A21".esc_html($monadiki).'"'); ?> width="600" height="200" 
    style="position: relative;"></canvas>

    <canvas id=<?php echo ('"'.esc_html($attr['name'])."A22".esc_html($monadiki).'"'); ?> width="600" height="200" 
    style="position: absolute; left: 0; top: 0; "></canvas>

    <canvas id=<?php echo ('"'.esc_html($attr['name'])."A23".esc_html($monadiki).'"'); ?> width="600" height="200" 
    style=" position: absolute; left: 0; top: 0; "></canvas> 
  </div>


  <script>

  function imtah_animation2Run()
  {

    var canvas=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A21".esc_html($monadiki).'"'); ?>);
    var ctx=canvas.getContext('2d');
    var canvas2=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A22".esc_html($monadiki).'"'); ?>);
    var ctx2=canvas2.getContext('2d')
    var canvas3=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A23".esc_html($monadiki).'"'); ?>);
    var ctx3=canvas3.getContext('2d')
    var w = canvas.width;
    var h = canvas.height;
    var img = new Image();  
    var img2 = new Image();    
    img.src =<?php echo ('"'.wp_get_attachment_url($attr['image1']).'"'); ?>;
    img2.src =<?php echo ('"'.wp_get_attachment_url($attr['image2']).'"'); ?>;
    var offset=0;
    var speed=16;     
    var i=0;          
    var dir=0;            
    ctx.textAlign ="center";  
    var inc=0;
    var txtColor = <?php echo ('"'.esc_html($attr['text_color']).'"'); ?>;
    var txt1= <?php echo ('"'.esc_html($attr['text1']).'"'); ?>;
    var txt2= <?php echo ('"'.esc_html($attr['text2']).'"'); ?>; 
    var txt3= <?php echo ('"'.esc_html($attr['text3']).'"'); ?>; 
    var txt4= <?php echo ('"'.esc_html($attr['text4']).'"'); ?>;
    var blurVal = 10;
    var increment = 100;
    var step = 0;
    var font = <?php echo ('"'.esc_html($attr['font']).'"'); ?>;
    var text = '';
    var text2 = '';
    var text3 = '';
    var iTxt=0;
    var txtLength = 0;
    var rh = h;
    var rw = 25;
    var t= 0;
    var rinc =0;
    var url= <?php echo ('"'.esc_url($attr['url']).'"'); ?>;
    var fontsize = h/2.1;

    function resize() {  
      var clientWidth=<?php echo (esc_html($attr['name']).esc_html($monadiki)."Div2"); ?>.parentElement.getBoundingClientRect().width;
      var width = clientWidth;
      var ratio = 3;
      var height = width / ratio;

      canvas.style.width = width+'px'; 
      canvas.style.height = height+'px';    
      canvas2.style.width = width+'px';  
      canvas2.style.height = height+'px';
      canvas3.style.width = width+'px';
      canvas3.style.height = height+'px';  
    } 

    window.addEventListener('load', resize, false); 
    window.addEventListener('resize', resize, false);


    function rectangle(x,y,width,height,speed,trigger)
    { 
      this.x = x; 
      this.y = y;  
      this.width = width;
      this.height = height;
      this.speed = speed;
      this.trigger = trigger; 
      this.frwCurrent = 0;  
      this.revCurrent = 0;
      this.frwOffset = 0; 
      this.revOffset = 0;    
      this.dir = 0; 

      this.revUpdate=function()
      {
        this.revCurrent += this.speed; 
        if (this.revOffset <= this.width/2) 
        {
          ctx2.fillRect((this.x + this.revOffset),this.y, this.width - this.revOffset*2, this.height); 
          if (this.revCurrent > this.trigger)
          {
            this.revOffset+=this.speed;
          }  
        }
      }

      this.frwUpdate=function()
      {
        this.frwCurrent += this.speed; 
        ctx.fillRect((this.x - this.frwOffset),this.y,this.frwOffset*2, this.height); 
        if (this.frwCurrent > this.trigger)
        {
          this.frwOffset+=this.speed; 
        }  
      }

      this.frwFeedback=function()
      {
        return this.frwOffset;
      }

    }

    var rectArray = [];
    for (var s = 0; s < h/rh; s++) 
    {
      for (var e = 0; e <= w/rw; e++)
      {   
        rectArray.push(new rectangle(e*rw, s*rh, 25, h, 0.5, 0*s*(h/rh)+e));         
      }
    }    

    function typeWriter(txt) {          
      if (iTxt < txt.length) {
        text += txt.charAt(iTxt); 
        iTxt++;
        txtLength=txt.length 
        write=1 
        return text 
      }
      else
      {
        text=txt
        write=0
        return text
      }
    }

    function deleteTypeWriter(txt) {
      if (iTxt > 0) { 
        text2=text.slice(0, iTxt);
        iTxt--; 
        return text2  
      }
      else
      {
        text=text2='' 
        return text2    
      }
    }
    //////////////////////////////////////////////display on visibility ////////////////////////////////////
    //var visibility = 0;

    function reveal()
    {
      var element = document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A23".$monadiki.'"'); ?>);
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
    var loop2;

    function createLines()  
    {
      loop2=requestAnimationFrame(createLines);
      ctx.clearRect(0,0,canvas.width,canvas.height);
      ctx2.clearRect(0,0,canvas2.width,canvas2.height); 
      ctx3.clearRect(0,0,canvas3.width,canvas3.height);
      ctx.globalCompositeOperation='source-over';
      ctx2.globalCompositeOperation='source-over';   
      ctx3.globalCompositeOperation='source-over'; 

      switch(i) { 

         case 0:
           resize();

           if (true)
           {  
             if (reveal() && i==0)
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
             i=70;
           }
        break;

        case 2: 
        
          if (<?php echo ('"'.$attr['image2'].'"'); ?> !=''&&<?php echo ('"'.$attr['image1'].'"'); ?> !='')
          {
            ctx.drawImage(img,canvas.width/2-((text.length/txt1.length)*canvas.width/2),0,(text.length/txt1.length)*canvas.width,canvas.height);        
            ctx.globalCompositeOperation='destination-in';   
            ctx.font = ""+"bold "+fontsize+"px "+font+"";      
            ctx.fillText(text,canvas.width/2,h/1.5) 
            if (txt1!= "" && <?php echo ('"'.$attr['image1'].'"'); ?> !='')
            {
              if (offset >= step )
              {
                step+=increment;  
                text=typeWriter(txt1)  
              }

              if ((text.length)==txtLength )  
              {
                setTimeout(function ()
                {
                  step=increment; 
                  text2=text; 
                  offset=0; 
                  i=10; 
                }, 300);
              }
              else
              {
                if(txt1!=""){
                offset+=speed; 
              }
              }
            }
            else
            {
              offset=0;
              text="";
              i=20;
              step=0;
            }
          }
          else
          {
            ctx.font = "20px Arial"; 
            ctx.fillText("No image please choose image",w/2,100);
            break;  
          }

        break;

        case 10:
          offset+=speed;
          if (offset>step)   
          {
            step+=increment/2;  
            text=deleteTypeWriter(txt1); 
          }
          ctx.globalCompositeOperation='source-over';

          if (text.length>0)
          {
            ctx.drawImage(img,canvas.width/2-((text.length/txt1.length)*canvas.width/2),0,(text.length/txt1.length)*canvas.width,canvas.height)  
          }      
          ctx.globalCompositeOperation='destination-in';   
          ctx.fillText(text2,canvas.width/2,h/1.5)

          if(text2==0)  
          { 
            i=20; 
            offset=0;
            step=increment; 
          }

        break;  

        case 20:
          if(txt2!=''&& <?php echo ('"'.$attr['image1'].'"'); ?> !='')
          { 
            if (offset >= step)
            {
              text=typeWriter(txt2)
              step+=increment;     
            }
            ctx.globalCompositeOperation='source-over'; 
            if (text.length > 0)
            {
              ctx.drawImage(img,canvas.width/2-((text.length/txt2.length)*canvas.width/2),0,(text.length/txt2.length)*canvas.width,canvas.height); 
            }       
            ctx.globalCompositeOperation='destination-in';       
            ctx.fillText(text,canvas.width/2,h/1.5)
            if ((text.length)==txtLength)  
            {
              setTimeout(function()
              {
                step=increment 
                text2=text 
                offset=0 
                i=30 
              }, 300);     
            }
            else
            {
              offset+=speed;  
            }
          }
          else
          {
            i=40;
            offset=0;
            text="";
            step=0;
          } 
        break;

        case 30:
          offset+=speed;

          if (offset>step)   
          {
            step+=increment/2;  
            text=deleteTypeWriter(txt2); 
          }

          if (text.length>0)
          {
            ctx.drawImage(img,canvas.width/2-((text.length/txt2.length)*canvas.width/2),0,(text.length/txt2.length)*canvas.width,canvas.height);
          }        
          ctx.globalCompositeOperation='destination-in';   
          ctx.fillText(text2,canvas.width/2,h/1.5)
          ctx.globalCompositeOperation='source-over';

          if(text2==0)
          {
            i=40;
            offset=0;
            step=increment; 
          }
        break; 

        case 40:
          if (txt3!=''&& <?php echo ('"'.$attr['image1'].'"'); ?> !='')
          { 
            if (offset >= step)
            {
              step+=increment;  
              text=typeWriter(txt3)  
            }
            if (text.length>0)
            {
              ctx.drawImage(img,canvas.width/2-((text.length/txt3.length)*canvas.width/2),0,(text.length/txt3.length)*canvas.width,canvas.height);
            }        
            ctx.globalCompositeOperation='destination-in';  
            ctx.filter=''      
            ctx.fillText(text,canvas.width/2,h/1.5)

            if ((text.length)==txtLength)  
            {
              setTimeout(function()
              {
                step=increment 
                offset=0 
                i=50;
                iTxt=0;
                var text4=text;
                text="";
              }, 500);     
            }
            else
            {
              offset+=speed;  
            }
          }
          else
          {
            i=50;
            offset=0;
            text="";
            step=0;
          }  
        break;


        case 50:

          if (txt3!='')
          {
            ctx.drawImage(img,canvas.width/2-(canvas.width/2),0,canvas.width,canvas.height)        
            ctx.globalCompositeOperation='destination-in';      
            ctx.font = ""+"bold "+fontsize+"px "+font+"";      
            ctx.fillText(txt3,canvas.width/2,h/1.5)
            ctx.globalCompositeOperation='destination-out';
          } 
          else
          {
            ctx.globalCompositeOperation='destination-in';
          } 

          ctx2.drawImage(img2,0,0,(canvas.width/2)-canvas.width/20,canvas.height)
          ctx2.fillStyle = txtColor;
          ctx2.font = ""+"bold "+fontsize/2.1+"px "+font+"";
          ctx2.fillText(txt1,canvas.width/2,canvas.height/4)
          ctx2.fillText(txt2,canvas.width/2,canvas.height/2)
          ctx2.fillText(txt3,canvas.width/2,canvas.height/1.33)
          ctx2.globalCompositeOperation='destination-out';      

          for (var c = 0; c < rectArray.length; c++){
            rectArray[c].revUpdate();      
            rectArray[c].frwUpdate();         
          }    
          var pos =   rectArray[0].frwFeedback();

          if (pos > 25)
          {
            inc++;  
          }

          if(txt4!='')
          {  
            if ( inc <= 50) {
              ctx3.fillStyle = "black";
              ctx3.filter="opacity("+(inc)+"%)";  
              ctx3.fillRect(0,h-h/4,w/2-w/20,w);     
            }  
            else 
            {
              ctx3.fillStyle = "black";
              ctx3.filter="opacity("+50+"%)";  
              ctx3.fillRect(0,h-h/4,w/2-w/20,w);     
            }  
          }

          if (offset >= step && inc >50 && txt4!='') 
          {
            step+=increment;  
            text3=typeWriter(txt4);  
          }
          ctx3.font = ""+(h/10)+"px "+font+""; 
          ctx3.fillStyle = "white";
          ctx3.filter="opacity("+80+"%)";
          ctx3.fillText(text3,w/50,h/1.1);

          if (pos>125)  
          {
            i=60; 
          }
          else
          {
            offset+=speed;  
          } 
        break;

        case 60:
          ctx2.drawImage(img2,0,0,(canvas.width/2)-canvas.width/20,canvas.height)
          ctx2.fillStyle = txtColor;
          ctx2.fillText(txt1,canvas.width/2,canvas.height/4)
          ctx2.fillText(txt2,canvas.width/2,canvas.height/2)
          ctx2.fillText(txt3,canvas.width/2,canvas.height/1.33)
          ctx2.globalCompositeOperation='destination-out';

          if(txt4!='')
          {   
            ctx3.fillStyle = "black";
            ctx3.filter="opacity("+50+"%)";  
            ctx3.fillRect(0,h-h/4,w/2-w/20,w);  
            ctx3.font = ""+(h/10)+"px "+font+""; 
            ctx3.fillStyle = "white";
            ctx3.filter="opacity("+80+"%)";
            ctx3.fillText(text,w/50,h/1.1);
          }
          cancelAnimationFrame(loop2);
        break; 

      } 
    }
    createLines();   
  }
  imtah_animation2Run();
  </script>  

<?php
$output = ob_get_clean();
return $output;
}

//////////////////////////////////////////////////////////////////////////////////

///Code for admin html output at animaton 2 settings/admin page

function imtah_display_animation2_html(){
  ?>
  <div style="float:right; margin-top:10%; margin-right:5%; width:60%";>
    <?php
    $A2Shortcode='[imtah_animation2 name="'.get_option( 'imtah_animation2_name' ).'" text_color="'.get_option( 'imtah_animation2_text_color' ).'" text1="'.get_option( 'imtah_animation2_text1' ).'" text2="'.get_option( 'imtah_animation2_text2' ).'" text3="'.get_option( 'imtah_animation2_text3' ).'" text4="'.get_option( 'imtah_animation2_text4' ).'" image1="'.get_option( 'imtah_animation2_image_attachment_id1' ).'" image2="'.get_option( 'imtah_animation2_image_attachment_id2' ).'" url="'.get_option( 'imtah_animation2_url' ).'" font="'.get_option( 'imtah_animation2_font' ).'"]' ;

    echo do_shortcode($A2Shortcode);
    
    ?>
  </div>

  <div style="float:left; margin-top:5%; width:20%  ">
    <h2>Animation2 settings</h2>
    <form method="post"  action="<?php echo esc_html(admin_url('admin-ajax.php')); ?>" id="A2form" >
    <?php wp_nonce_field('imtah_A2add_transfer','imtah_A2update_security_nonce'); ?>
    <input name="action" value="imtah_A2add_transfer" type="hidden">
      <table width="100%" cellpadding="10"  style="border:2px solid" >
        <tr>
          <td align="left" scope="row">
            <label>Animation Name: <?php echo esc_html(get_option( 'imtah_animation2_name' )); ?></label>
          </td> 
        </tr>

        <tr>
          <td align="left" scope="row">
          <label>Text font:</label>
            <select name="imtah_animation2_font">
              <option style="display:none" > <?php echo esc_html(get_option( 'imtah_animation2_font' ));?> </option>
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
            <label style="margin-right:5px; padding-bottom:15px;">Text color</label><input type="text" name="imtah_animation2_text_color" value="<?php echo esc_html(get_option( 'imtah_animation2_text_color' )); ?>" class="my-color-field" />
          </td> 
        </tr>


        <tr>
          <td align="left" scope="row">
            <label>Text1</label><input type="text" name="imtah_animation2_text1" 
              value="<?php echo esc_html(get_option( 'imtah_animation2_text1' )); ?>" />
          </td> 
        </tr>

        <tr>
          <td align="left" scope="row">
            <label>Text2</label><input type="text" name="imtah_animation2_text2" 
            value="<?php  echo esc_html(get_option( 'imtah_animation2_text2' )); ?>" />
          </td> 
        </tr>

        <tr>
          <td align="left" scope="row">
            <label>Text3</label><input type="text" name="imtah_animation2_text3" 
            value="<?php  echo esc_html(get_option( 'imtah_animation2_text3' )); ?>" />
          </td> 
        </tr>

        <tr>
          <td align="left" scope="row">
            <label>Text4</label><input type="text" name="imtah_animation2_text4" 
            value="<?php  echo esc_html(get_option( 'imtah_animation2_text4' )); ?>" />
          </td> 
        </tr>

        <tr>
          <td align="left" scope="row">
            <label>Url</label><input type="text" name="imtah_animation2_url" 
            value="<?php  echo esc_url(get_option( 'imtah_animation2_url' )); ?>" />
          </td> 
        </tr>

        <tr>
          <td align="left" >
            <p>Masked image</p>
            <img id='imtah_animation2_image-preview1' src='<?php echo wp_get_attachment_url( get_option( 'imtah_animation2_image_attachment_id1' ) ); ?>' height='100'>
            <br>
            <input id="imtah_animation2_upload_image_button1" type="button" class="button" value= "Upload image" />
          </td> 

          <td align="left" >
            <p>Headline image</p>
            <img id='imtah_animation2_image-preview2' src='<?php echo wp_get_attachment_url( get_option( 'imtah_animation2_image_attachment_id2' ) ); ?>' height='100'>
            <br>
            <input id="imtah_animation2_upload_image_button2" type="button" class="button" value= "Upload image" />
          </td> 

        </tr>

      </table>
      <p class="submit">

        <input type="hidden" name="A2saveAs" id="A2inputForSaveAs"/>
        <input type="hidden" name="A2update" id="A2inputForUpdate"/>
        <input type="hidden" name="A2save" id="A2inputForSave"/>
        <input type="hidden" name="imtah_animation2_name" id="A2NameInput" value='<?php echo esc_html(get_option( 'imtah_animation2_name' )); ?>' />
        <input type='hidden' name='imtah_animation2_image_attachment_id1' id='imtah_animation2_image_attachment_id1' value='<?php echo esc_html(get_option( 'imtah_animation2_image_attachment_id1' )); ?>'/>
        <input type='hidden' name='imtah_animation2_image_attachment_id2' id='imtah_animation2_image_attachment_id2' value='<?php echo esc_html(get_option( 'imtah_animation2_image_attachment_id2' )); ?>'/>
        <input type="hidden" name="page_options" value="imtah_animation2_name, imtah_animation2_text1, imtah_animation2_text2, imtah_animation2_text3, imtah_animation2_text4, imtah_animation2_image_attachment_id1, imtah_animation2_image_attachment_id2, imtah_animation2_text_color, imtah_animation2_font, imtah_animation2_url " /> 
        <button type="button" id="A2UpdateButton">Update </button>
        <button type="button" id="A2SaveButton">Save </button>
        <button type="button" id="A2SaveAsButton">Save as </button>

      </p>

    </form>

    <script>

    (function($)
    {
      $(document).ready(function()
      {
        //////////////////Save As button//////////////////////////////////
        $( "#A2SaveAsButton" ).click(function() {
          var newname = prompt("Please input a name: ");
          if(!newname) return;
          $('#A2NameInput').val(newname);
          $('#A2inputForSaveAs').val("yes");

          var data = {
            'action': 'imtah_A2my_action',
            'security': '<?php echo wp_create_nonce( "ajax-nonce-A2" ); ?>',
            'A2name': newname
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
                $('#A2form').submit();
              }
          }); 
        });

        //////////////////Save button//////////////////////////////////
        $( "#A2SaveButton" ).click(function() {
          var newdirname1 = <?php echo ('"'.esc_html(get_option( 'imtah_animation2_name' ))).'"'; ?>;
          if(!newdirname1) return;
          $('#A2NameInput').val(newdirname1);
          $('#A2inputForSave').val("yes");
          $('#A2form').submit();
          alert("save " + newdirname1 + "?");     
        });

        //////////////////Update button//////////////////////////////////
        $( "#A2UpdateButton" ).click(function() {
          $('#A2inputForUpdate').val("yes");
          $('#A2form').submit();   
        });
      });

    }(jQuery));//This is for replacing JQuery with $

    </script>

  </div>
    <?php
    ////////////////////////Create an instance of our package class...DISPLAY TABLE
    $imtah_testListTable2 = new imtah_ItemsAnimation2_List_Table();
    //Fetch, prepare, sort, and filter our data...
    $imtah_testListTable2->prepare_items();
    ?>
  <div style="clear: both; padding-top: 10px;">

    <h2>Animation2 recipe list table</h2>
    <!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
    <form id="Items-filter" method="get">
      <!-- For plugins, we also need to ensure that the form posts back to our current page -->
      <input type="hidden" name="page" value="<?php echo esc_html($_REQUEST['page']) ?>" />
      <!-- Now we can render the completed list table -->
      <?php $imtah_testListTable2->display() ?>
    </form> 
  </div>
  <?php
  }

  ////////////////////////////////////////// END OF FUNCTION display_animation2_html
  
  //////Handle form submission inside a function////////////////////////
  add_action('wp_ajax_imtah_A2add_transfer', 'imtah_A2process_add_transfer');

  function imtah_A2process_add_transfer() {
  if ( empty($_POST) || !wp_verify_nonce($_POST['imtah_A2update_security_nonce'],'imtah_A2add_transfer') || !current_user_can('manage_options' ) ) 
    {
      echo 'You targeted the right function, but sorry, your did not verify.';
      die();
    } 
    else 
    {
       if ( $_POST['A2saveAs']=='yes' )
        {
          imtah_A2saveas();
          imtah_A2update();    
        }
      else if ( $_POST['A2save']=='yes' )
        {
          imtah_A2save();
          imtah_A2update();    
        }
      else if ( $_POST['A2update']=='yes' )
        {
          imtah_A2update();    
        }  
       wp_redirect(wp_get_referer());exit;
      
    }
  }

    // SaveAS VALUES TO NEW ROW /////
  function imtah_A2saveas(){
    global $wpdb;
    //insert values to a new row
    $wpdb->insert($wpdb->prefix . 'imtah_animation2Table',
    array(
      'name' => sanitize_text_field($_POST['imtah_animation2_name']) ,
      'textFont' => sanitize_text_field($_POST['imtah_animation2_font']) , 
      'text1' => sanitize_text_field($_POST['imtah_animation2_text1']) ,
      'text2' => sanitize_text_field($_POST['imtah_animation2_text2']) ,
      'text3' => sanitize_text_field($_POST['imtah_animation2_text3']) ,
      'text4' => sanitize_text_field($_POST['imtah_animation2_text4']) ,
      'textColor' => sanitize_text_field($_POST['imtah_animation2_text_color']) ,
      'imagepath1' =>  get_option( 'imtah_animation2_image_attachment_id1' ),
      'imagepath2' =>  get_option( 'imtah_animation2_image_attachment_id2' ),
      'url' => sanitize_text_field($_POST['imtah_animation2_url'])  
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
      '%s',
      '%s'
    )  );
  }

  // Save VALUES TO NEW ROW /////
  function imtah_A2save(){
    global $wpdb;
    $myName=get_option( 'imtah_animation2_name' );
    //SELECT THE CORRECT ID
    $myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation2Table WHERE name = '$myName'");
    //insert values to a new row
    $wpdb->replace($wpdb->prefix . 'imtah_animation2Table',
    array(
      'id'=> $myId,
      'name' => sanitize_text_field($_POST['imtah_animation2_name']) ,
      'textFont' => sanitize_text_field($_POST['imtah_animation2_font']) , 
      'text1' => sanitize_text_field($_POST['imtah_animation2_text1']) ,
      'text2' => sanitize_text_field($_POST['imtah_animation2_text2']) ,
      'text3' => sanitize_text_field($_POST['imtah_animation2_text3']) ,
      'text4' => sanitize_text_field($_POST['imtah_animation2_text4']) ,
      'textColor' => sanitize_text_field($_POST['imtah_animation2_text_color']) ,
      'imagepath1' =>  get_option( 'imtah_animation2_image_attachment_id1' ),
      'imagepath2' =>  get_option( 'imtah_animation2_image_attachment_id2' ),
      'url' => sanitize_text_field($_POST['imtah_animation2_url'])    
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
      '%s',
      '%s' 
    )  );
  }
  
  // Just update values
  function imtah_A2update(){
    update_option( 'imtah_animation2_name', sanitize_text_field($_POST['imtah_animation2_name']));
    update_option( 'imtah_animation2_font', sanitize_text_field($_POST['imtah_animation2_font']));
    update_option( 'imtah_animation2_text1', sanitize_text_field($_POST['imtah_animation2_text1']));
    update_option( 'imtah_animation2_text2', sanitize_text_field($_POST['imtah_animation2_text2']));
    update_option( 'imtah_animation2_text3', sanitize_text_field($_POST['imtah_animation2_text3']));
    update_option( 'imtah_animation2_text4', sanitize_text_field($_POST['imtah_animation2_text4']));
    update_option( 'imtah_animation2_text_color', sanitize_text_field($_POST['imtah_animation2_text_color']));
    update_option( 'imtah_animation2_url', sanitize_text_field($_POST['imtah_animation2_url']));  
  }

  ////////////////////////////////////////////
  add_action('wp_ajax_imtah_A2my_action', 'imtah_A2my_action');
  add_action('wp_ajax_imtah_A2update_picture1', 'imtah_A2update_picture1');
  add_action('wp_ajax_imtah_A2update_picture2', 'imtah_A2update_picture2');

  // FUNCTION FOR CHECKING IF NAME ALREADY EXISTS
  function imtah_A2my_action()
  {
    global $wpdb; // this is how you get access to the database
    // security check
    check_ajax_referer( 'ajax-nonce-A2', 'security' );
    $name = $_POST['A2name'];

    if (imtah_A2IsNameExists($name)=="yes")
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
  function imtah_A2IsNameExists($checkName)
  {
    global $wpdb;
    $result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation2Table");

    foreach ( $result as $value ) 
    {
      if ($value->name == $checkName)
      {
      return 'yes';   
      }
    }
  }

  //Function for updating image option on wp.media upload
  function imtah_A2update_picture1(){
    $imageId1 = sanitize_text_field($_POST['imageId1']);
    check_ajax_referer( 'ajax_A2_img_nonce', 'security' );
    if ($imageId1)
      {
      update_option( 'imtah_animation2_image_attachment_id1', $imageId1 );
      echo $imageId1;
      }
    die();
  }

  function imtah_A2update_picture2(){
    $imageId2 = sanitize_text_field($_POST['imageId2']);
    check_ajax_referer( 'ajax_A2_img_nonce', 'security' );
     if ($imageId2)
     {
       update_option( 'imtah_animation2_image_attachment_id2', $imageId2 );
     }
    die();
  }

//Function for updating values from table,triggered from process bulk actions
function imtah_A2update_from_table(){
  global $wpdb;
  $mylink = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation2Table WHERE id =".$_REQUEST['A2item']);
  update_option( 'imtah_animation2_name', $mylink->name);
  update_option( 'imtah_animation2_font', $mylink->textFont);
  update_option( 'imtah_animation2_text1', $mylink->text1);
  update_option( 'imtah_animation2_text2', $mylink->text2);
  update_option( 'imtah_animation2_text3', $mylink->text3);
  update_option( 'imtah_animation2_text4', $mylink->text4);
  update_option( 'imtah_animation2_text_color', $mylink->textColor);
  update_option( 'imtah_animation2_image_attachment_id1', $mylink->imagepath1);
  update_option( 'imtah_animation2_image_attachment_id2', $mylink->imagepath2);
  update_option( 'imtah_animation2_url', $mylink->url);  
}

//delete function, triggered from process bulk actions
function imtah_A2del_options(){
    global $wpdb;
    $myName=get_option( 'imtah_animation2_name' );
    $myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation2Table WHERE name = '$myName'");

    if (is_null($myId)) 
    {
      update_option( 'imtah_animation2_name', "");
      update_option( 'imtah_animation2_font', "");
      update_option( 'imtah_animation2_text1', "");
      update_option( 'imtah_animation2_text2', "");
      update_option( 'imtah_animation2_text3', "");
      update_option( 'imtah_animation2_text4', "");
      update_option( 'imtah_animation2_text_color', "");
      update_option( 'imtah_animation2_image_attachment_id1', ""); 
      update_option( 'imtah_animation2_image_attachment_id2', "");
      update_option( 'imtah_animation2_url', "");
    }
} 


///////////////////Code for WP_list_table/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if(!class_exists('WP_List_Table')){
  require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class imtah_ItemsAnimation2_List_Table extends WP_List_Table {

//Get data from table
function get_items() 
{
  global $wpdb;
  $sql = "SELECT * FROM " . $wpdb->prefix . 'imtah_animation2Table';
  $result = $wpdb->get_results( $sql, 'ARRAY_A' );
  return $result;
}   

function __construct()
{
  global $status, $page;
  //Set parent defaults
  parent::__construct( array(
  'singular'  => 'A2item',     //singular name of the listed records
  'plural'    => 'A2items',    //plural name of the listed records
  'ajax'      => false        //does this table support ajax?
  ) );
}

function delete_item( $id ) {
  global $wpdb;
  $wpdb->delete(
    "{$wpdb->prefix}imtah_animation2Table",
    [ 'id' => $id ],
    [ '%d' ]
  );
} 

function column_default($item, $column_name){
  switch($column_name)
  {
    //case 'name':
    case 'textColor':
    case 'text1':
    case 'text2':
    case 'text3':
    case 'text4':
    case 'textFont':
    case 'imagepath1':
    case 'imagepath2':
    case 'url':

    return $item[$column_name];
    default:
    return print_r($item,true); //Show the whole array for troubleshooting purposes
  }
}

function column_name($item){
    // create a nonce
  $edit_nonce = wp_create_nonce( 'imtah_A2edit_item' );
  $delete_nonce = wp_create_nonce( 'imtah_A2delete_item' );
  //Build row actions
  $item_json = json_decode(json_encode($item), true);
  $actions = array(
    'edit'      => sprintf('<a href="?page=%s&action=%s&A2item=%s&_wpnonce=%s">Edit</a>',$_REQUEST['page'],'editA2',$item['id'],$edit_nonce),
    'delete' => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', $_REQUEST['page'], 'deleteA2', $item_json['id'],$delete_nonce)
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
  // );
}


function get_columns(){
  $columns = array(
    'cb'     => '<input type="checkbox" />', //Render a checkbox instead of text
    'name'   => 'Name',
    'textColor'   => 'Text color',
    'textFont'   => 'Text font',
    'text1'   => 'Text1',
    'text2'   => 'Text2',
    'text3'   => 'Text3',
    'text4'   => 'Text4',
    'imagepath1'  => 'Image1 id',
    'imagepath2'  => 'Image2 id',
    'url'  => 'Url'
  );
  return $columns;
}

function get_sortable_columns(){
  $sortable_columns = array(
    'name'     => array('Name',false),     //true means it's already sorted
  );
  return $sortable_columns;
}

function get_bulk_actions() {
  $actions = array(
    'bulkDeleteA2'    => 'Delete'
  );
  return $actions;
}

function process_bulk_action() {
    //Detect when a delete action is being triggered...
  if ( 'deleteA2' === $this->current_action() ) 
  {
    // In our file that handles the request, verify the nonce.
    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
    if ( wp_verify_nonce( $nonce, 'imtah_A2delete_item' ) ) 
    {
      self::delete_item( absint( $_GET['id'] ) );
      imtah_A2del_options();
      wp_redirect(wp_get_referer());
      exit;
    }

  }

  // If the delete bulk action is triggered
  if ( 'bulkDeleteA2' === $this->current_action() ) 
  {
    // loop over the array of record IDs and delete them
    foreach ($_GET['id'] as $id ) {
      $SanitizedId=sanitize_text_field( $id );
      self::delete_item( $SanitizedId );
      imtah_A2del_options();
    }
    wp_redirect(wp_get_referer());
    exit;
  }

  //if edit action is triggered
  if('editA2'==$this->current_action())
  {
    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
    if ( wp_verify_nonce( $nonce, 'imtah_A2edit_item' ) ) 
    {
      imtah_A2update_from_table(absint( $_GET['ABitem'] ));
      wp_redirect(wp_get_referer());
      exit;
    }
    
  } 

}


function prepare_items() {
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
  function usort_reorder($a,$b){
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