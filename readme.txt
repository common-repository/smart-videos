=== Video Embed ===
Contributors: Mark Cleberns
Tags: HTML5, videos, video.js,  HTML5 video, HTML5 video player, HTML5 video gallery, wordpress HTML5 video, wordpress HTML5 video player, wordpress HTML5 video gallery, responsive, wordpress responsive video gallery, video 
Requires at least: 3.1
Tested up to: 3.8
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A smart, easy way to add responsive HTML5 Video gallery and Video player to your Wordpress Site.

== Description ==

This plugin add a responsive HTML5 Video Player and Video gallery to Wordpress Site.

The plugin adds a Video gallery tab to your admin menu, which allows you to enter Video Title and Video source items just as you would regular posts.
Also added setting page "Smartvideo Settings" under "setting" menu to set the height and width of your video player.  

Now just create a new page and add this short code <code>[sp_smartvideo limit="-1"] </code> to your page. You can also use PHP code <code> <?php echo do_shortcode('[sp_smartvideo limit="-1"]'); ?></code> directly to your template file.

= Features include: =
* Create a Video gallery page.
* Add a Video player to your page.
* Setting page "smartvideo Settings" under "setting" menu to set the height and width of your video player.  
* Simple plugin so that you can customize it as per your need.
* With basic wordpress knowladge you can create your own SHORT CODE
* Easy to configure
* Smoothly integrates into any theme


== Installation ==

1. Upload the 'html5_videogallery_and_player' folder to the '/wp-content/plugins/' directory.
2. Activate the 'SP HTML5 Video Player and Video gallery'  plugin through the 'Plugins' menu in WordPress.
3. Go to setting page "smartvideo Settings" under "setting" and add height and width of player.
4. Add a new page and add this short code <code>[sp_smartvideo limit="-1"] </code>.
5. Add php code directly to your template file <code> <?php echo do_shortcode('[sp_smartvideo limit="-1"]'); ?> </code> inside php code. 

### How to add video gallery page
Create a page with any name and enter <code>[sp_smartvideo limit="-1"]</code> short code in to your page OR  <code> <?php echo do_shortcode('[sp_smartvideo limit="-1"]'); ?> </code> to your template file.

### How to add video files in to your page
Upload all there format(mp4,ogg,webm) through Media and paste all these code and links like this under "Video Gallery -> Add New"
    
    <source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
    <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
	
### How to add video player directly in to your page
Just copy this code and enter in to your page 
<code>
<video id="video_705" class="video-js vjs-default-skin" controls preload="none" width="400" height="250" poster="http://yourdomainname.com/potesr.jpg"  data-setup="{}">		
	<source src="http://video-js.zencoder.com/oceans-clip.mp4" type='video/mp4' />
    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
    <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />		
</video>	
</code>


== Frequently Asked Questions ==

= What Video Gallery templates are available? =

There is one templates named 'smartvideo.php' which work like same as defult POST TYPE in wordpress. Depend upon height and width provided by you under Setting page "setting-> smartvideo Settings" menu, you can display One OR Two video player in a row.  


= Are there shortcodes for Video Gallery items? =

Yes, Add a new page and add this short code <code>[sp_smartvideo limit="-1"] </code>

= Are there PHP code for Video Gallery items? =

Yes,  <code> <?php echo do_shortcode('[sp_smartvideo limit="-1"]'); ?> </code>

== Changelog ==

= 1.0 =
* Initial release
* Adds Video Gallery
* Adds Video player


== Upgrade Notice ==

= 1.0 =
Initial release www.wordpress.org
