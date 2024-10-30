<?php
//Attach style and javascript

add_action('admin_enqueue_scripts', 'imtah_Enqueue3');
add_action('wp_enqueue_scripts', 'imtah_Enqueue3');

function imtah_Enqueue3() {
	wp_enqueue_script('imtahA3_script', plugins_url( 'js/animation3.js', __FILE__), array('jquery','media-upload'), 2017, true );
	//passing variables to the javascript file (cannot write php in the js file)
  wp_localize_script('imtahA3_script', 'frontEndAjaxA3', array(
  'ajaxurl' => admin_url( 'admin-ajax.php' ),
  'nonce' => wp_create_nonce('ajax_A3_img_nonce')
  ));
}
 ////register settings and sanitize
function imtah_animation3_register_settings()
{
  add_option( 'imtah_animation3_name', 'Name1');
  add_option( 'imtah_animation3_text1', 'THIS');
  add_option( 'imtah_animation3_text2', 'IS');
  add_option( 'imtah_animation3_text3', 'ANIMATION3');
  add_option( 'imtah_animation3_text4', 'TEXT AND IMAGE');
  add_option( 'imtah_animation3_image_attachment_id1', '');
  add_option( 'imtah_animation3_image_attachment_id2', '');
  add_option( 'imtah_animation3_text_color', '#000000');
  add_option( 'imtah_animation3_font', 'Impact');
  add_option( 'imtah_animation3_url', ''); 

  register_setting( 'imtah_settings', 'imtah_animation3_name', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_text1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_text2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_text3', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_text4', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_image_attachment_id1', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_image_attachment_id2', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_text_color', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_font', array('type' => 'string','sanitize_callback' => 'sanitize_text_field'));
  register_setting( 'imtah_settings', 'imtah_animation3_url', array('type' => 'string','sanitize_callback' => 'sanitize_text_field')); 
}

add_action( 'admin_init', 'imtah_animation3_register_settings' );

//////////////////////////////////////////////////////////////////////
//Shortcode function for calling animation1 with select shortcut
add_shortcode( 'canvasanimation3', 'imtah_my_shortcutForAnim3' );

function imtah_my_shortcutForAnim3( $attr ) {
	// Configure defaults and extract the attributes into variables
	shortcode_atts( 
	array(
		'attributes'=> '',
		), $attr
	);

	global $wpdb;
	$myQuery = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation3Table WHERE name ='{$attr['attributes']}'");

	$MyShortcode = do_shortcode('[imtah_animation3 name="'.$myQuery->name.'" text_color="'.$myQuery->textColor.'" text1="'.$myQuery->text1.'" text2="'.$myQuery->text2.'" text3="'.$myQuery->text3.'" text4="'.$myQuery->text4.'" image1="' .$myQuery->imagepath1.'" image2="' .$myQuery->imagepath2.'" url="' .$myQuery->url.'" font="' .$myQuery->textFont.'"]');
	ob_start();
  echo $MyShortcode;
  return ob_get_clean();     
}
//Add shortcode
add_shortcode( 'imtah_animation3', 'imtah_disAnimation3' );
///////////////////////////////////////////////////////////////////
//Shortcode function for Html code for animation 1 front end output
function imtah_disAnimation3($attr){

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
	<div onclick="<?php if($attr['url']!=""){echo "location.href="."'".esc_url($attr['url'])."'".'"';}?>" id= <?php echo ('"'.esc_html($attr['name']).esc_html($monadiki)."Div3".'"'); ?> style="position: relative;  <?php if($attr['url']!=""){echo "display: block; cursor: pointer;";} ?> ">
		<canvas id=<?php echo ('"'.esc_html($attr['name'])."A31".esc_html($monadiki).'"'); ?> width="600" height="200" 
		style="position: relative; z-index:3;"></canvas>

		<canvas id=<?php echo ('"'.esc_html($attr['name'])."A32".esc_html($monadiki).'"'); ?> width="600" height="200" 
		style="position: absolute; left: 0; top: 0; z-index:2;"></canvas>

		<canvas id=<?php echo ('"'.esc_html($attr['name'])."A33".esc_html($monadiki).'"'); ?> width="600" height="200" 
	    style=" position: absolute; left: 0; top: 0; z-index:1;"></canvas> 
	</div>

	<script>
		function imtah_animation3Run(){
			var canvas=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A31".esc_html($monadiki).'"'); ?>);
			var ctx=canvas.getContext('2d');
			var canvas2=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A32".esc_html($monadiki).'"'); ?>);
			var ctx2=canvas2.getContext('2d');
			var canvas3=document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A33".esc_html($monadiki).'"'); ?>);
			var ctx3=canvas3.getContext('2d');
			var w = canvas.width;
			var h = canvas.height;
			var img = new Image();     
			var img2 = new Image();
			img.crossOrigin = "anonymous";
			img2.crossOrigin = "anonymous";      
			img.src =<?php echo ('"'.wp_get_attachment_url($attr['image1']).'"'); ?>;
			img2.src =<?php echo ('"'.wp_get_attachment_url($attr['image2']).'"'); ?>;
			var offset=0;  
			var speed=2.5; //for rectangle function
			var refSpeed=0;
			var acc1 = 1;
			var i=0;    
			var dir=0;
			ctx.textAlign ="center"; 
			ctx2.textAlign ="center";
			ctx3.textAlign ="center";
			var txt1= <?php echo ('"'.esc_html($attr['text1']).'"'); ?>;
	    var txt2= <?php echo ('"'.esc_html($attr['text2']).'"'); ?>; 
	    var txt3= <?php echo ('"'.esc_html($attr['text3']).'"'); ?>; 
	    var txt4= <?php echo ('"'.esc_html($attr['text4']).'"'); ?>;
			var trigger = 0; 
			var pos1 = 0;
			var speed1 = 0;
			var bounce1 = 0;
			var dir1 = 0;
			var fric1 = 0; 
			var iTxt=0
			var txtLength = 0;
			var rh = 40;
			var rw = 40;
			var t= 0;
			var rinc =0;
			var inc = 0;
			var text = '';
			var url= <?php echo ('"'.esc_url($attr['url']).'"'); ?>;
			var font = <?php echo ('"'.esc_html($attr['font']).'"'); ?>;
			var txtColor = <?php echo ('"'.esc_html($attr['text_color']).'"'); ?>;
			var fontsize = h/2.2;
	        var t=0;

			//////////resize//////////////////////
			function resize() {  
				var clientWidth=<?php echo (esc_html($attr['name']).esc_html($monadiki)."Div3"); ?>.parentElement.getBoundingClientRect().width;
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

			////////////////////////////////
			function typeWriter(txt) {          
				if (iTxt < txt.length) 
				{
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
			////////////////////////////////
			function rectangle(x,y,width,height,speed,trigger)
			{
				this.x = x; 
				this.y = y;  
				this.width = width;
				this.height = height;
				this.speed = speed;
				this.trigger = trigger; 
				this.current = 0;  
				this.offset = 0;   
				this.imageData=[];
				this.getImg=function()
				{
					this.imageData = ctx2.getImageData(this.x, this.y, this.width, this.height);
				}
	      this.show=function()
				{
					if (this.current < rw/2 || this.current < rh/2)
					this.current+=this.speed
					{
						ctx.fillRect(this.x + rw/2 - this.current  , this.y + rh/2 - this.current  ,this.current*2, this.current*2);
						ctx2.putImageData(this.imageData, this.x + rw/2 - this.current , this.y + rh/2 - this.current , 0, 0, this.current*2, this.current*2);
					}
				}
				this.update=function()
				{
					this.current += this.speed;
					if (this.current <= rw/2 || this.current <= rh/2)
					{
						this.offset+=this.speed;
						ctx2.fillRect(this.x + this.offset , this.y + this.offset ,this.width-this.offset*2, this.height-this.offset*2);
					}
					ctx.putImageData(this.imageData, this.x, this.y, this.offset, this.offset, this.width-this.offset*2, this.height-this.offset*2);
				}  	


				this.frwFeedback=function()
				{
				return this.current;
				}

			}

			var rectArray = [];

			for (var s = 0; s < h/rh; s++) 
			{
				for (var e = 0; e <= w/rw; e++)
				{   
					rectArray.push(new rectangle(e*rw, s*rh, rw, rh, 1, 10));         
				}
			}


			////////////////////////////////Create seq Array and then mixit/////////////////////////////////////
			function fisherYates ( myArray ) {
				var i = myArray.length;
				if ( i == 0 ) return false;
				while ( --i ) {
					var j = Math.floor( Math.random() * ( i + 1 ) );
					var tempi = myArray[i];
					var tempj = myArray[j];
					myArray[i] = tempj;
					myArray[j] = tempi;
				}
			}

			///////////////Create sequencial array///
	    const fillRange = (start, end) => {
	      return Array(end - start + 1).fill().map((item, index) => start + index);
	    };

	    const allLines = fillRange(0, rectArray.length-1); 
		  
			  ///////and mix it 
			fisherYates(allLines);


			//////////////////////////////////////////////display on visibility ////////////////////////////////////

			function reveal()
			{
				var element = document.getElementById(<?php echo ('"'.esc_html($attr['name'])."A33".$monadiki.'"'); ?>);
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
			////////////////////////////////

			var loop3;

			function createLines()  
			{
				loop3=requestAnimationFrame(createLines);
				ctx.clearRect(0,0,canvas.width,canvas.height);
				ctx2.clearRect(0,0,canvas2.width,canvas2.height);
				ctx3.clearRect(0,0,canvas2.width,canvas2.height);
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
								if (i==0){
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

						if (txt1!='' && <?php echo ('"'.$attr['image2'].'"'); ?> !='' && <?php echo ('"'.$attr['image1'].'"'); ?> !='')
						{
							ctx.drawImage(img, pos1-w, 0,w,h); 
							ctx.globalCompositeOperation='destination-in';     
							ctx.lineWidth=10;       
							ctx.strokeStyle = "white";
							ctx.font = ""+"bold "+fontsize+"px "+font+"";
							ctx.fillText(txt1,pos1-w/2,h/1.5);   

							if ((pos1 > canvas.width) && dir1 == 0)       
							{
								bounce1++;
								dir1=1; 
							}

							if ((pos1 <canvas.width) && dir1 == 1) 
							{
								bounce1++;
								dir1=0;
							}

							if (pos1 < canvas.width)
							{
								speed1 += acc1 + bounce1;
							}

							if (pos1 > canvas.width)
							{
								speed1 -= 3*acc1 + bounce1;
							}

							if (bounce1 > 6)             
							{ 
								offset++;
								if (offset>30)
								{
									offset=0;
									fric1=1; 
									bounce1=0; 
									pos1=0;
									acc1=2;
									speed1=0; 
									i=10; 
								}       
							}
							else
							{
								fric1=1- bounce1 * 0.15; 
								speed1 *= fric1;  
								pos1 += speed1;  
							}
							break;    
						}
					else if (txt1=='' && <?php echo ('"'.$attr['image2'].'"'); ?> !='' && <?php echo ('"'.$attr['image1'].'"'); ?> !='')
					{
						offset=0;
						fric1=1; 
						bounce1=0; 
						pos1=0;
						acc1=2;
						speed1=0; 
						i=10;
					}

					else
					{
						ctx.font = "20px Arial"; 
						ctx.fillText("No image please choose image",w/2,100);
						break;
					}
					break;


					case 10:

					if (txt1!='')
					{
						ctx.drawImage(img, pos1, 0,w,h); 
						ctx.globalCompositeOperation='destination-in';     
						ctx.lineWidth=10;     
						ctx.fillText(txt1,pos1+w/2,h/1.5);
					}

					if (txt2!='')
					{ 
						if ((pos1 > canvas.width) && dir1 == 0)       
						{
							bounce1++; 
							dir1=1;  
						}
						if ((pos1 <canvas.width) && dir1 == 1) 
						{
							bounce1++;
							dir1=0; 
						} 

						if (pos1 < canvas.width)
						{
							speed1 += acc1+bounce1;
						}

						if (pos1 > canvas.width)
						{
							speed1 -= acc1 ;
						}

						ctx2.drawImage(img,pos1-w,0,w,h); 
						ctx2.fillStyle="white";
						ctx2.font = ""+"bold "+fontsize+"px "+font+""; 
						ctx2.fillText(txt2,pos1-w/2,h/1.5) 

						if (bounce1 > 6)            
						{ 
							offset++
							if (offset>30)
							{
								i=20; 
								fric1=1;
								bounce1=0;
								speed1=0;
								acc1=1;
								offset=0
							}    
						}
						else
						{
							fric1=1-bounce1 * 0.1; 
							speed1 *= fric1;  
							pos1 += speed1; 
						}
					}
					else 
					{
						i=20; 
						fric1=1;
						bounce1=0;
						speed1=0;
						acc1=1;
						offset=0
					}    
					break;    

					case 20:
					if (txt3!='')
					{
						if (txt2 !='')
						{      
							ctx2.drawImage(img,pos1-w,0,w,h);  
							ctx2.fillText(txt2,pos1-canvas.width/2,h/1.5) 
							ctx2.fillRect(pos1 ,0,w,h);
						}
						if(pos1>20)
						{
							ctx3.drawImage(img, 0, 0,w,h); 
							ctx3.globalCompositeOperation='destination-in';
							ctx3.lineWidth=10;  
							ctx3.strokeStyle = "white";    
							ctx3.font = ""+"bold "+(pos1/20)+"px "+font+""; 
							ctx3.fillText(txt3,w/2,h/1.5);  
						}
						speed1 += acc1 
						speed1 *= fric1;   
						pos1 += speed1*2;  

						if (pos1> 2500)
						{
							i=30; 
							acc1=20;
						}
					}
					else
					{
						offset=0; 
						fric1=1;
						ctx2.textAlign ="left";
						ctx.font = ""+"bold "+(pos1/20)+"px "+font+"";
						i=40;
					}

					break;     

					case 30: 
					ctx3.drawImage(img, 0, 0,w,h); 
					ctx3.globalCompositeOperation='destination-in';
					ctx3.lineWidth=10;  
					ctx3.strokeStyle = "white";    
					ctx3.font =""+"bold "+(pos1/20)+"px "+font+""; 
					ctx3.fillText(txt3,w/2,h/1.5); 

					if (bounce1 > 4)           
					{
						offset++
						if (offset>5)
						{
							offset=0; 
							fric1=1;
							ctx2.textAlign ="left";
							ctx.font = ""+"bold "+(pos1/20)+"px "+font+"";
							i=40;
						} 
					}
					else
					{
						if ((pos1/20 > fontsize) && dir1 == 1)       
						{
							bounce1++;
							dir1=0; 
						}

						if ((pos1/20 < fontsize) && dir1 == 0) 
						{
							bounce1++;
							dir1=1;
						}

						if (pos1/20 < fontsize)
						{
							speed1 += acc1; 
						}

						if (pos1/20 > fontsize)  
						{
							speed1 -= acc1;  
						}

						fric1= 1 - bounce1 * 0.2; 
						speed1 *= fric1;  
						pos1 += speed1;
					}
					break;

					case 40:
					offset++;

					if (offset <= 10)
					{

						if (txt3!='')
						{
							ctx.textAlign ="center";
							ctx.drawImage(img, 0, 0,w,h);      
							ctx.globalCompositeOperation='destination-in';         
							ctx.fillText(txt3,w/2,h/1.5) 
						}
						else if (txt1 !='' && txt2 =='')
						{
							ctx.drawImage(img, 0, 0,w,h); 
							ctx.globalCompositeOperation='destination-in';     
							ctx.lineWidth=10;       
							ctx.strokeStyle = "white";
							ctx.font = ""+"bold "+fontsize+"px "+font+"";
							ctx.fillText(txt1,w/2,h/1.5);
						}
						else if ((txt2 !='' && txt1 =='' ) || (txt1 !='' && txt2 !=''))
						{
							ctx.drawImage(img,0,0,w,h); 
							ctx.fillStyle="white";
							ctx.font = ""+"bold "+fontsize+"px "+font+""; 
							ctx.fillText(txt2,w/2,h/1.5) 
						}

						if (offset == 10)
						{
							ctx2.drawImage(img2,0,0,(w/2)-w/20,h)
							ctx2.fillStyle = txtColor;
							ctx2.font = ""+"bold "+fontsize/2+"px "+font+""; 
							ctx2.fillText(txt1,canvas.width/2,canvas.height/4)
							ctx2.fillText(txt2,canvas.width/2,canvas.height/2)
							ctx2.fillText(txt3,canvas.width/2,canvas.height/1.33)
			   			for (var c = 0; c < rectArray.length; c++){
	              rectArray[c].getImg();	   
	            }
	            ctx2.clearRect(0,0,canvas2.width,canvas2.height); 
						}
					}
					else
					{
						ctx.textAlign ="center";
						ctx.drawImage(img, 0, 0,w,h);      
						ctx.globalCompositeOperation='destination-in';         
						ctx.fillText(txt3,w/2,h/1.5) 
						ctx.globalCompositeOperation='destination-out';      

						if (t <= allLines.length-1) 
						{
					    t++;
						  t++;
						  t++;
						  t++;
						  t++;
						}
			
				    for (var a = 0; a < t; a++){
			        rectArray[allLines[a]].show();	   
			      }

					}

					var pos = rectArray[allLines[allLines.length-1]].frwFeedback();
					if (pos>(rw/2)-1 || pos>(rh/2)-1)
					{
						i=50;
						offset=0;
					}
					break;

					case 50:
					ctx2.drawImage(img2,0,0,(w/2)-w/20,h)
					ctx2.fillText(txt1,canvas.width/2,canvas.height/4)
					ctx2.fillText(txt2,canvas.width/2,canvas.height/2)
					ctx2.fillText(txt3,canvas.width/2,canvas.height/1.33)
					ctx2.globalCompositeOperation='destination-out';
	        //console.log(offset)
					if (offset<350 && inc<350)
					{
						offset++;
						inc++;
						inc++;
					}
					else
					{
						cancelAnimationFrame(loop3);
					}

					if(txt4!='')
					{  

						if ( inc <= 50) {
							ctx.fillStyle = "black";   
							ctx.filter="opacity("+(inc)+"%)";  
							ctx.fillRect(0,h-h/4,w/2-w/20,w);     
						}  
						else  
						{
							ctx.fillStyle = "black";
							ctx.filter="opacity("+50+"%)";  
							ctx.fillRect(0,h-h/4,w/2-w/20,w);	
									
							if (offset>3 )
							{
								text = typeWriter(txt4);
								offset=0;
							} 
						}  
					}

					ctx.textAlign ="left";  
					ctx.font = ""+h/10+"px "+font+"";  
					ctx.fillStyle = "white";
					ctx.filter="opacity("+80+"%)";
					ctx.fillText(text,w/50,h/1.1);
					
					break;

				} 

			}
			createLines();

		}
	    imtah_animation3Run();

	</script>

  <?php

  $output = ob_get_clean();

	return $output;
}
//////////////////////////////////////////////////////////////////////////////////
///Code for admin html output at animaton 2 settings/admin page

function imtah_display_animation3_html(){
?>
<div style="float:right; margin-top:10%; margin-right:5%; width:60%";>
	<?php
	$A3Shortcode='[imtah_animation3 name="'.get_option( 'imtah_animation3_name' ).'" text_color="'.get_option( 'imtah_animation3_text_color' ).'" text1="'.get_option( 'imtah_animation3_text1' ).'" text2="'.get_option( 'imtah_animation3_text2' ).'" text3="'.get_option( 'imtah_animation3_text3' ).'" text4="'.get_option( 'imtah_animation3_text4' ).'" image1="'.get_option( 'imtah_animation3_image_attachment_id1' ).'" image2="'.get_option( 'imtah_animation3_image_attachment_id2' ).'" url="'.get_option( 'imtah_animation3_url' ).'" font="'.get_option( 'imtah_animation3_font' ).'"]' ;

	echo do_shortcode($A3Shortcode);
	?>
</div>

<div style="float:left; margin-top:5%; width:20%  ">

	<h2>Animation3 settings</h2>

	<form method="post"  action="<?php echo esc_html(admin_url('admin-ajax.php')); ?>" id="A3form">
		<?php 
		wp_nonce_field('imtah_A3add_transfer','imtah_A3update_security_nonce'); 
		?>
		<input name="action" value="imtah_A3add_transfer" type="hidden">
		<table width="auto" cellpadding="10"  style="border:2px solid #000000 !important;" >

			<tr>
				<td align="left" scope="row">
					<label>Animation Name: <?php echo esc_html(get_option( 'imtah_animation3_name' )); ?></label>
				</td> 
			</tr>

			<tr>
				<td align="left" scope="row">
					<label>Text font:</label>
					<select name="imtah_animation3_font">
						<option style="display:none" > <?php echo esc_html(get_option( 'imtah_animation3_font' ));?> </option>
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
					<label style="margin-right:5px; padding-bottom:15px;">Text color</label><input type="text" name="imtah_animation3_text_color" value="<?php echo esc_html(get_option( 'imtah_animation3_text_color' )); ?>" class="my-color-field" />
				</td> 
			</tr>


			<tr>
				<td align="left" scope="row">
					<label>Text1</label><input type="text" name="imtah_animation3_text1" 
					value="<?php echo esc_html(get_option( 'imtah_animation3_text1' )); ?>" />
				</td> 
			</tr>

			<tr>
				<td align="left" scope="row">
					<label>Text2</label><input type="text" name="imtah_animation3_text2" 
					value="<?php  echo esc_html(get_option( 'imtah_animation3_text2' )); ?>" />
				</td> 
			</tr>

			<tr>
				<td align="left" scope="row">
					<label>Text3</label><input type="text" name="imtah_animation3_text3" 
					value="<?php  echo esc_html(get_option( 'imtah_animation3_text3' )); ?>" />
				</td> 
			</tr>

			<tr>
				<td align="left" scope="row">
					<label>Text4</label><input type="text" name="imtah_animation3_text4" 
					value="<?php  echo esc_html(get_option( 'imtah_animation3_text4' )); ?>" />
				</td> 
			</tr>

			<tr>
				<td align="left" scope="row">
					<label>Url</label><input type="text" name="imtah_animation3_url" 
					value="<?php  echo esc_url(get_option( 'imtah_animation3_url' )); ?>" />
				</td> 
			</tr>

			<tr>
				<td align="left" >
					<p>Masked image</p>
					<img id='imtah_animation3_image-preview1' src='<?php echo wp_get_attachment_url( get_option( 'imtah_animation3_image_attachment_id1' ) ); ?>' height='100'>
					<br>
					<input id="imtah_animation3_upload_image_button1" type="button" class="button" value= "Upload image" />
				</td> 
				<td align="left" >
					<p>Headline image</p>
					<img id='imtah_animation3_image-preview2' src='<?php echo wp_get_attachment_url( get_option( 'imtah_animation3_image_attachment_id2' ) ); ?>' height='100'>
					<br>
					<input id="imtah_animation3_upload_image_button2" type="button" class="button" value= "Upload image" />
				</td> 
			</tr>

		</table>

		<p class="submit">
			<input type="hidden" name="A3saveAs" id="A3inputForSaveAs"/>
			<input type="hidden" name="A3update" id="A3inputForUpdate"/>
			<input type="hidden" name="A3save" id="A3inputForSave"/>
			<input type="hidden" name="imtah_animation3_name" id="A3NameInput" value='<?php echo esc_html(get_option( 'imtah_animation3_name' )); ?>' />
			<input type='hidden' name='imtah_animation3_image_attachment_id1' id='imtah_animation3_image_attachment_id1' value='<?php echo esc_html(get_option( 'imtah_animation3_image_attachment_id1' )); ?>'/>
			<input type='hidden' name='imtah_animation3_image_attachment_id2' id='imtah_animation3_image_attachment_id2' value='<?php echo esc_html(get_option( 'imtah_animation3_image_attachment_id2' )); ?>'/>
			<input type="hidden" name="page_options" value="imtah_animation3_name, imtah_animation3_text1, imtah_animation3_text2, imtah_animation3_text3, imtah_animation3_text4, imtah_animation3_image_attachment_id1, imtah_animation3_image_attachment_id2, imtah_animation3_text_color, imtah_animation3_font, imtah_animation3_url " /> 
			<button type="button" id="A3UpdateButton">Update </button>
			<button type="button" id="A3SaveButton">Save </button>
			<button type="button" id="A3SaveAsButton">Save as </button>
		</p>

	</form>

	<script>

		(function($){
			$(document).ready(function(){
			//////////////////Save As button//////////////////////////////////
			  $( "#A3SaveAsButton" ).click(function() {
					var newname = prompt("Please input a name: ");
					if(!newname) return;
					$('#A3NameInput').val(newname);
					$('#A3inputForSaveAs').val("yes");

					var data = {
						'action': 'imtah_A3my_action',
						'security': '<?php echo wp_create_nonce( "ajax-nonce-A3" ); ?>',
						'A3name': newname
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
	              $('#A3form').submit();
	            }
					});
				});

				//////////////////Save button//////////////////////////////////
				$( "#A3SaveButton" ).click(function() {
					var newdirname1 = <?php echo ('"'.esc_html(get_option( 'imtah_animation3_name' ))).'"'; ?>;
					if(!newdirname1) return;
					$('#A3NameInput').val(newdirname1);
					$('#A3inputForSave').val("yes");
					$('#A3form').submit();
					alert("save " + newdirname1 + "?");     
				});

				//////////////////Update button//////////////////////////////////
				$( "#A3UpdateButton" ).click(function() {
					$('#A3inputForUpdate').val("yes");
					$('#A3form').submit();   
				});

			});
		}(jQuery));//This is for replacing JQuery with $

	</script>

	</div>
	<?php
	////////////////////////Create an instance of our package class...DISPLAY TABLE
	$imtah_testListTable3 = new imtah_ItemsAnimation3_List_Table();
	//Fetch, prepare, sort, and filter our data...
	$imtah_testListTable3->prepare_items();
	?>
	<div style="clear: both; padding-top: 10px;">
		<h2>Animation3 recipe list table</h2>
		<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
		<form id="Items-filter" method="get">
			<!-- For plugins, we also need to ensure that the form posts back to our current page -->
			<input type="hidden" name="page" value="<?php echo esc_html($_REQUEST['page']) ?>" />
			<!-- Now we can render the completed list table -->
			<?php $imtah_testListTable3->display() ?>
		</form> 
	</div>
	<?php
}

////////////////////////////////////////// END OF FUNCTION display_animation2_html////////////////////////////////
add_action('wp_ajax_imtah_A3add_transfer', 'imtah_A3process_add_transfer');

function imtah_A3process_add_transfer() {
if ( empty($_POST) || !wp_verify_nonce($_POST['imtah_A3update_security_nonce'],'imtah_A3add_transfer') || !current_user_can('manage_options' ) ) 
  {
    echo 'You targeted the right function, but sorry, your did not verify.';
    die();
  } 
  else 
  {
     if ( $_POST['A3saveAs']=='yes' )
      {
        imtah_A3saveas();
        imtah_A3update();    
      }
    else if ( $_POST['A3save']=='yes' )
      {
        imtah_A3save();
        imtah_A3update();    
      }
    else if ( $_POST['A3update']=='yes' )
      {
        imtah_A3update();    
      }  
     wp_redirect(wp_get_referer());exit;
    
  }
}

  // SaveAS VALUES TO NEW ROW /////
function imtah_A3saveas(){
  global $wpdb;
	//insert values to a new row
	$wpdb->insert($wpdb->prefix . 'imtah_animation3Table',
	array(
		'name' => sanitize_text_field($_POST['imtah_animation3_name']) ,
		'textFont' => sanitize_text_field($_POST['imtah_animation3_font']) , 
		'text1' => sanitize_text_field($_POST['imtah_animation3_text1']) ,
		'text2' => sanitize_text_field($_POST['imtah_animation3_text2']) ,
		'text3' => sanitize_text_field($_POST['imtah_animation3_text3']) ,
		'text4' => sanitize_text_field($_POST['imtah_animation3_text4']) ,
		'textColor' => sanitize_text_field($_POST['imtah_animation3_text_color']) ,
		'imagepath1' =>  get_option( 'imtah_animation3_image_attachment_id1' ),
		'imagepath2' =>  get_option( 'imtah_animation3_image_attachment_id2' ),
		'url' => sanitize_text_field($_POST['imtah_animation3_url'])  
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
	));

}

// Save VALUES TO NEW ROW /////
function imtah_A3save(){
  global $wpdb;
  $myName=get_option( 'imtah_animation3_name' );
	//SELECT THE CORRECT ID
	$myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation3Table WHERE name = '$myName'");

	//insert values to a new row
	$wpdb->replace($wpdb->prefix . 'imtah_animation3Table',
	array(
		'id'=> $myId,
		'name' => sanitize_text_field($_POST['imtah_animation3_name']) ,
		'textFont' => sanitize_text_field($_POST['imtah_animation3_font']) , 
		'text1' => sanitize_text_field($_POST['imtah_animation3_text1']) ,
		'text2' => sanitize_text_field($_POST['imtah_animation3_text2']) ,
		'text3' => sanitize_text_field($_POST['imtah_animation3_text3']) ,
		'text4' => sanitize_text_field($_POST['imtah_animation3_text4']) ,
		'textColor' => sanitize_text_field($_POST['imtah_animation3_text_color']) ,
		'imagepath1' =>  get_option( 'imtah_animation3_image_attachment_id1' ),
		'imagepath2' =>  get_option( 'imtah_animation3_image_attachment_id2' ),
		'url' => sanitize_text_field($_POST['imtah_animation3_url'])    
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
	));
}

// Just update values
function imtah_A3update(){
  update_option( 'imtah_animation3_name', sanitize_text_field($_POST['imtah_animation3_name']));
	update_option( 'imtah_animation3_font', sanitize_text_field($_POST['imtah_animation3_font']));
	update_option( 'imtah_animation3_text1', sanitize_text_field($_POST['imtah_animation3_text1']));
	update_option( 'imtah_animation3_text2', sanitize_text_field($_POST['imtah_animation3_text2']));
	update_option( 'imtah_animation3_text3', sanitize_text_field($_POST['imtah_animation3_text3']));
	update_option( 'imtah_animation3_text4', sanitize_text_field($_POST['imtah_animation3_text4']));
	update_option( 'imtah_animation3_text_color', sanitize_text_field($_POST['imtah_animation3_text_color']));
	update_option( 'imtah_animation3_url', sanitize_text_field($_POST['imtah_animation3_url']));  
}

add_action('wp_ajax_imtah_A3my_action', 'imtah_A3my_action');
add_action('wp_ajax_imtah_A3update_picture1', 'imtah_A3update_picture1');
  add_action('wp_ajax_imtah_A3update_picture2', 'imtah_A3update_picture2');
// FUNCTION FOR CHECKING IF NAME ALREADY EXISTS
function imtah_A3my_action(){
	global $wpdb; // this is how you get access to the database
	// security check
  check_ajax_referer( 'ajax-nonce-A3', 'security' );
	$name = $_POST['A3name'];

	if (imtah_A3IsNameExists($name)=="yes")
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
function imtah_A3IsNameExists($checkName){
	global $wpdb;
	$result = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}imtah_animation3Table");

	foreach ( $result as $value ) {
		if ($value->name == $checkName)
		{
			return 'yes';   
		}
	}
}

//Function for updating image option on wp.media upload
function imtah_A3update_picture1(){
  $imageId1 = sanitize_text_field($_POST['imageId1']);
  check_ajax_referer( 'ajax_A3_img_nonce', 'security' );
  if ($imageId1)
    {
    update_option( 'imtah_animation3_image_attachment_id1', $imageId1 );
    echo $imageId1;
    }
  die();
}

function imtah_A3update_picture2(){
  $imageId2 = sanitize_text_field($_POST['imageId2']);
  check_ajax_referer( 'ajax_A3_img_nonce', 'security' );
   if ($imageId2)
   {
     update_option( 'imtah_animation3_image_attachment_id2', $imageId2 );
   }
  die();
}

//Function for updating values from table
function imtah_A3update_from_table(){
	global $wpdb;
	$mylink = $wpdb->get_row("SELECT * FROM {$wpdb->prefix}imtah_animation3Table WHERE id =".$_REQUEST['A3item']);
	update_option( 'imtah_animation3_name', $mylink->name);
	update_option( 'imtah_animation3_font', $mylink->textFont);
	update_option( 'imtah_animation3_text1', $mylink->text1);
	update_option( 'imtah_animation3_text2', $mylink->text2);
	update_option( 'imtah_animation3_text3', $mylink->text3);
	update_option( 'imtah_animation3_text4', $mylink->text4);
	update_option( 'imtah_animation3_text_color', $mylink->textColor);
	update_option( 'imtah_animation3_image_attachment_id1', $mylink->imagepath1);
	update_option( 'imtah_animation3_image_attachment_id2', $mylink->imagepath2);
	update_option( 'imtah_animation3_url', $mylink->url);  
}

//delete action
function imtah_A3del_options(){
  global $wpdb;
	$myName=get_option( 'imtah_animation3_name' );
	$myId = $wpdb->get_var("SELECT id FROM {$wpdb->prefix}imtah_animation3Table WHERE name = '$myName'");
  $myIdArray = $wpdb->get_results( "SELECT id FROM {$wpdb->prefix}imtah_animation3Table" );
  $myIdValArray = wp_list_pluck( $myIdArray, 'id' );
  
  if (in_array($myId, $myIdValArray))//Validate if value is an id from sql table
  {
    $ids = isset($_REQUEST['id']) ? sanitize_text_field($_REQUEST['id']) : array();
  }  

	if ($myId==$ids) {
		update_option( 'imtah_animation3_name', "");
		update_option( 'imtah_animation3_font', "");
		update_option( 'imtah_animation3_text1', "");
		update_option( 'imtah_animation3_text2', "");
		update_option( 'imtah_animation3_text3', "");
		update_option( 'imtah_animation3_text4', "");
		update_option( 'imtah_animation3_text_color', "");
		update_option( 'imtah_animation3_image_attachment_id1', ""); 
		update_option( 'imtah_animation3_image_attachment_id2', "");
		update_option( 'imtah_animation3_url', "");
	}
} 


///////////////////Code for WP_list_table/////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class imtah_ItemsAnimation3_List_Table extends WP_List_Table {

	//Get data from table
	function get_items() {
		global $wpdb;
		$sql = "SELECT * FROM " . $wpdb->prefix . 'imtah_animation3Table';
		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}   

	function __construct(){
		global $status, $page;
		//Set parent defaults
		parent::__construct( array(
			'singular'  => 'A3item',     //singular name of the listed records
			'plural'    => 'A3items',    //plural name of the listed records
			'ajax'      => false        //does this table support ajax?
		));
	}

	function delete_item( $id ) {
		global $wpdb;
    $wpdb->delete(
	    "{$wpdb->prefix}imtah_animation3Table",
	    [ 'id' => $id ],
	    [ '%d' ]
	  );
	} 

	function column_default($item, $column_name){
		switch($column_name)
		{
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
	  $edit_nonce = wp_create_nonce( 'imtah_A3edit_item' );
	  $delete_nonce = wp_create_nonce( 'imtah_A3delete_item' );
		//Build row actions
		$item_json = json_decode(json_encode($item), true);
		$actions = array(
			'edit'      => sprintf('<a href="?page=%s&action=%s&A3item=%s&_wpnonce=%s">Edit</a>',$_REQUEST['page'],'editA3',$item['id'],$edit_nonce),
			'delete' => sprintf('<a href="?page=%s&action=%s&id=%s&_wpnonce=%s">Delete</a>', $_REQUEST['page'], 'deleteA3', $item_json['id'],$delete_nonce)
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

	function get_sortable_columns() {
		$sortable_columns = array(
			'name'     => array('Name',false),     //true means it's already sorted
		);
		return $sortable_columns;
	}

	function get_bulk_actions(){
		$actions = array(
			'bulkDeleteA3'    => 'Delete'
		);
		return $actions;
	}

	function process_bulk_action() {
		//Detect when a delete action is being triggered...
	  if ( 'deleteA3' === $this->current_action() ) 
	  {
	    // In our file that handles the request, verify the nonce.
	    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
	    if ( wp_verify_nonce( $nonce, 'imtah_A3delete_item' ) ) 
	    {
	      self::delete_item( absint( $_GET['id'] ) );
	      imtah_A3del_options();
	      wp_redirect(wp_get_referer());
	      exit;
	    }

	  }

	  // If the delete bulk action is triggered
	  if ( 'bulkDeleteA3' === $this->current_action() ) 
	  {
	    // loop over the array of record IDs and delete them
	    foreach ($_GET['id'] as $id ) {
	      $SanitizedId=sanitize_text_field( $id );
	      self::delete_item( $SanitizedId );
	      imtah_A3del_options();
	    }
	    wp_redirect(wp_get_referer());
	    exit;
	  }

	  //if edit action is triggered
	  if('editA3'==$this->current_action())
	  {
	    $nonce = esc_attr( $_REQUEST['_wpnonce'] );
	    if ( wp_verify_nonce( $nonce, 'imtah_A3edit_item' ) ) 
	    {
	      imtah_A3update_from_table(absint( $_GET['ABitem'] ));
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
		));
	}
}
?>