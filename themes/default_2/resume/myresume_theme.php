<?php

// if not defined


function myresume_theme()
{
	global $globals, $mysql, $theme, $done, $errors, $l;
	
	// Get all data of the user, whether to allow 
	// him to view or enter the board.
	// user level, user permissions
	global $user;
	global $board, $replies;
	global $qu;
	
	global $arrSubPat, $availImgs, $imagesListFile, $imagesListFolder, $contents;
	
	/*
	body {
		padding:50px 80px;
		font-family:'Lucida Grande','bitstream vera sans','trebuchet ms',sans-serif,verdana;
	}
	* 
	*/
	$css = "
			
			/* get rid of those system borders being generated for A tags */
			a:active {
				outline:none;
			}

			:focus {
				-moz-outline-style:none;
			}
	
			/* root element for tabs  */
			ul.tabs {
				list-style:none;
				margin:0 !important;
				padding:0;
				border-bottom:1px solid #666;
				height:30px;
			}

			/* single tab */
			ul.tabs li {
				float:left;
				text-indent:0;
				padding:0;
				margin:0 !important;
				list-style-image:none !important;
			}

			/* link inside the tab. uses a background image */
			ul.tabs a {
				background: url(images/site/blue.png) no-repeat -420px 0;
				font-size:11px;
				display:block;
				height: 30px;
				line-height:30px;
				width: 134px;
				text-align:center;
				text-decoration:none;
				color:#333;
				padding:0px;
				margin:0px;
				position:relative;
				top:1px;
			}

			ul.tabs a:active {
				outline:none;
			}

			/* when mouse enters the tab move the background image */
			ul.tabs a:hover {
				background-position: -420px -31px;
				color: #fff;
			}

			/* active tab uses a class name 'current'. its highlight is also done by moving the background image. */
			ul.tabs a.current, ul.tabs a.current:hover, ul.tabs li.current a {
				background-position: -420px -62px;
				cursor:default !important;
				color:#000 !important;
			}

			/* Different widths for tabs: use a class name: w1, w2, w3 or w2 */


			/* width 1 */
			ul.tabs a.s { background-position: -553px 0; width:81px; }
			ul.tabs a.s:hover { background-position: -553px -31px; }
			ul.tabs a.s.current  { background-position: -553px -62px; }

			/* width 2 */
			ul.tabs a.l { background-position: -248px -0px; width:174px; }
			ul.tabs a.l:hover { background-position: -248px -31px; }
			ul.tabs a.l.current { background-position: -248px -62px; }


			/* width 3 */
			ul.tabs a.xl { background-position: 0 -0px; width:248px; }
			ul.tabs a.xl:hover { background-position: 0 -31px; }
			ul.tabs a.xl.current { background-position: 0 -62px; }


			/* initially all panes are hidden */
			.panes .pane {
				display:none;
			}

			/* tab pane styling */
			.panes div {
				display:none;
				padding:15px 10px;
				border:1px solid #999;
				border-top:0;
				height: auto;
				font-size:14px;
				background-color:#fff;
			}
			
			/* Image tooltip */
			.tooltip
			{
				border: 1px solid red;
			}
			
	";
	
	//printrr($arrSubPat);
	
	$str = '';
	$li = '';
	$li_div = '';
	
	/*
	*/
	echo "<div align='right'><input class='btn-custom' type='button' value='Call'><br />
	<small>(or schedule an automatic call for later time and date. Goto Call options.)</small></div><br /><br />";
	
	foreach($arrSubPat['node'] as $k => $v)
	{
		$li .= "<li><a href='#'>$v[title]</a></li>";
		
		// $li_div, can not close the <div> tag here, as <div> is getting 'binded' to <li> tags
		// in the jquery file, so closing it below
		$li_div .= "<div>$v[desc]";
		
		$h1 = '';
		$h2 = '';
		
		if(isset($v['node']))
		{
			foreach($v['node'] as $k2 => $v2)
			{
				
				$htmlStr = ( isset($v2['desc']) ? $v2['desc'] : '' );
				
				if( isset($v2['title']) && strtolower($v2['title'] ) == 'languages' )
				{
					if(isset($v2['desc'] ))
					{
						//echo $v3['desc'];
						//$htmlStr = preg_replace('/[^a-zA-Z0-9 ]+/', "", $v2['desc']);
						$htmlStr = preg_replace('/[^a-zA-Z0-9 ]+/', "", $htmlStr);
						$htmlStr = trim($htmlStr);
						//echo $htmlStr;
						
						$descArr = array();
						$descArr = explode( " ", $htmlStr );
						
						//printrr($descArr);
						
						foreach( $descArr as $wk => &$wv )
						{
							$img = strtolower(trim($wv));
							if(in_array($img, $availImgs ) )
							{
								//$descArr[$wk] = "<img src='$imagesListFile/$wv.jpeg' height='100' width='100'>";
								//$wv = "<img src='$imagesListFolder/$wv.jpeg' height='100' width='100' desc='$wv' alt='$wv'>";
								//$wv = "<img src='file://$imagesListFolder/$wv.jpeg' height='100' width='100' desc='$wv' alt='$wv' tooltip='$wv'>";
								$wv = "<img src='$globals[boardurl]/themes/$user[theme_type]/images/$theme[folder]/$img.jpeg' height='100' width='100' desc='$wv' alt='$wv' title='$wv'>";
							}
							
						}
						
						$htmlStr = implode( " ", $descArr);
						
					}
					
				}
				
				$h1 .= "<p><span><h3>".(isset($v2['title']) ? '<u>'.$v2['title'] .'</u>:' : '' )."</h3></span>
							<span>$htmlStr</span>
				</p><br />";
				
				if(isset($v2['node']))
				{
					foreach($v2['node'] as $k3 => $v3)
					{
						$h2 .= "<p><span><h4>".(isset($v3['title']) ? $v3['title'] .':' : '' )."</h4></span>
									<span>".(isset($v3['desc']) ? $v3['desc'] : '' )."</span>
						</p><br />";
					}
				}
			}
		}
		
		$string = "$h1$h2";
		// Closing </div> tag here
		$li_div .= "$string</div>";
		
	}
	
	$str .= "<ul class='tabs'>$li</ul>";
	$str .= "<div class='panes'>
					$li_div
		</div>";
	
	// css declaration
	$cssDecl = "<style type='text/css'>$css</style>";
	
	$script = '';
	$script = "
		<script type='text/javascript' language='javascript'>
			$(function() {
				// setup ul.tabs to work as tabs for each div directly under div.panes
				$('ul.tabs').tabs('div.panes > div');
				
				//$('[title]').tooltip();
			});
		</script>";
	
	echo $cssDecl . $str . $script;
	
}


?>
