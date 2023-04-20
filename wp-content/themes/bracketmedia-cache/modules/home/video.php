<?php $video_placeholder = get_sub_field('video_placeholder');?>
<?php $video_type = get_sub_field('video_type');?>
<?php if(($video_type==0) && ($video_home = get_sub_field('video_home'))) { ?>
    <section class="home__video" >
        <div class="home__video__cont" data-aos="fade-up">
            <video preload playsinline loop>
                <source src="<?php echo $video_home['url']; ?>#t=0.1" type="video/mp4">
            </video>
            <div class="controls">
                <div class="video-controls pause">PAUSE</div>
            </div>
            <svg class="play-button" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <path fill="#ffffff" d="M256,0C114.833,0,0,114.844,0,256s114.833,256,256,256s256-114.844,256-256S397.167,0,256,0z M256,490.667
                C126.604,490.667,21.333,385.396,21.333,256S126.604,21.333,256,21.333S490.667,126.604,490.667,256S385.396,490.667,256,490.667
                z"/>
            <path fill="#ffffff" d="M357.771,247.031l-149.333-96c-3.271-2.135-7.5-2.25-10.875-0.396C194.125,152.51,192,156.094,192,160v192
                c0,3.906,2.125,7.49,5.563,9.365c1.583,0.865,3.354,1.302,5.104,1.302c2,0,4.021-0.563,5.771-1.698l149.333-96
                c3.042-1.958,4.896-5.344,4.896-8.969S360.813,248.99,357.771,247.031z M213.333,332.458V179.542L332.271,256L213.333,332.458z"
                />
            </svg>

            <?php if($video_placeholder):?>
                <div class="image_placeholder">
                    <div class="image-background">
                        <img src="<?php echo esc_url($video_placeholder['sizes']['large']); ?>" alt="<?php echo esc_attr($video_placeholder	['alt']); ?>" />
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php }elseif((strlen($videourl=get_sub_field('videourl'))) && ($video_type==1)){ ?>
    <?php
    $output='';
    if(strlen($videourl)>0){
        if(preg_match("'youtu'",$videourl)){ // Youtube
            if(preg_match("'https://youtu.be/'",$videourl)){
                $videoId=preg_replace("'https://youtu.be/'","",$videourl);
            }else{

                if(preg_match("'watch'",$videourl)){
                    $video=preg_replace("'https://www.youtube.com/watch'","",$videourl);
                    $videoId=trim(substr($video,3,strlen($video)));
                }
            }
            $output='https://www.youtube.com/embed/'.$videoId.'?rel=0';
        }else{
            if(preg_match("'vimeo'",$videourl)){ // vimeo
                $partes=preg_split("'/'",$videourl);
                if((is_array($partes)) && (count($partes)>2)){
                    $ind=(sizeof($partes)-1);
                    $videoId=$partes[$ind];
                }else{
                    if(preg_match("'https://vimeo.com/'",$videourl)){ 
                        $videoId=trim(preg_replace("'https://vimeo.com/'","",$videourl));
                    }
                }
                $output='https://player.vimeo.com/video/'.$videoId;
            }else{
                if(preg_match("'dailymotion'",$videourl)){ // DailyMotion
                    if(!preg_match("'embed'",$videourl)){
                        $videourl=preg_replace("'/video'","/embed/video",$videourl);
                        $output=$videourl;
                    }
                }
            }
        }
    }
    ?>
    <?php if(strlen($output)){ ?>

        <section class="home__video" >
            <div class="home__video__cont" data-aos="fade-up">
                
                <div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="<?php echo $output; ?>" allowfullscreen></iframe></div>
<?php /*
                <div class="controls2">
                    <div class="video-controls pause2">PAUSE</div>
                </div>

                <svg class="play-button2" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="100px" width="100px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <path fill="#ffffff" d="M256,0C114.833,0,0,114.844,0,256s114.833,256,256,256s256-114.844,256-256S397.167,0,256,0z M256,490.667
                        C126.604,490.667,21.333,385.396,21.333,256S126.604,21.333,256,21.333S490.667,126.604,490.667,256S385.396,490.667,256,490.667
                        z"/>
                    <path fill="#ffffff" d="M357.771,247.031l-149.333-96c-3.271-2.135-7.5-2.25-10.875-0.396C194.125,152.51,192,156.094,192,160v192
                        c0,3.906,2.125,7.49,5.563,9.365c1.583,0.865,3.354,1.302,5.104,1.302c2,0,4.021-0.563,5.771-1.698l149.333-96
                        c3.042-1.958,4.896-5.344,4.896-8.969S360.813,248.99,357.771,247.031z M213.333,332.458V179.542L332.271,256L213.333,332.458z"
                        />
                </svg>
*/ ?>
                <?php if($video_placeholder):?>
                    <div class="image_placeholder podcast">
                        <div class="image-background">
                            <img src="<?php echo esc_url($video_placeholder['sizes']['large']); ?>" alt="<?php echo esc_attr($video_placeholder	['alt']); ?>" />
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    <?php } ?>
<?php } ?>

