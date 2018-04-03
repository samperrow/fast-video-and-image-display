<?php

if ( !defined ( 'ABSPATH' ) ) {
	exit;
}

class GKTVI_Media_Buttons {

    public function __construct() {
        add_action( 'media_buttons', array( $this,'create_media_buttons' ), 15, 2 );
        add_action( 'media_buttons', array( $this, 'create_video_modal' ), 15, 2 );
    }

    public function create_media_buttons() { 
        ?>

        <a href='#' id='gktDeferImage' class='button'>
            <span style='margin: 3px 5px 0 0;' class='dashicons dashicons-images-alt'></span>Defer Image Load</a>
    
        <a href='#TB_inline?width=900&amp;height=500&amp;inlineId=gktDeferVideo' id='gktviShowModal' class='thickbox button' title='Enter the YouTube video information to generate a shortcode.'>
            <span style='margin: 3px 5px 0 0;' class='dashicons dashicons-video-alt3'></span>Defer YouTube Video</a>

    <?php
    }

    public function create_video_modal() {

        ?>
        <div class="hidden" id="gktDeferVideo" width="500">
            <table class="gkt-form-table">
                <tbody>
                    <tr>
                        <td>
                            <p>YouTube Video URL:</p>
                        </td>
                        <td>
                            <label>
                                <input type="text" id="gkt-video-url" class="widefat gktvi-element" />
                            </label>
                            <i>"https://www.youtube.com/watch?v=sGUNPMPrxvA", for example</i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Video Width (px):</p>
                        </td>
                        <td>
                            <label>
                                <input size="20" type="text" id="gkt-video-width" class="gktvi-element" />
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Video Height (px):</p>
                        </td>
                        <td>
                            <label>
                                <input size="20" type="text" id="gkt-video-height" class="gktvi-element" />
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Video Thumbnail Resolution:</p>
                        </td>
                        <td>
                            <select id="gkt-video-res" class="gktvi-element">
                                <option value="hqdefault">High Quality</option>
                                <option value="mqdefault">Medium Quality</option>
                                <option value="sddefault">Standard Quality</option>
                                <option value="maxresdefault">Maximum Resolution</option>
                            </select>
    
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Mobile Friendly?</p>
                        </td>
                        <td>
                            <select id="gkt-video-mobile" class="gktvi-element">
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Video CSS Class:</p>
                            <i style="display: block; margin-top: -18px;">(optional)</i>
                        </td>
                        <td>
                            <label>
                                <input type="text" id="gkt-video-class" class="widefat" class="gktvi-element" />
                            </label>
                        </td>
                    </tr>
                </tbody>
            </table>
            <input id='gkt-yt-submit-btn' type='button' class='button button-primary gkt-ytvideo-insert' value='Insert Shortcode' />
        </div>
    
        <?php
    }
}

new GKTVI_Media_Buttons();