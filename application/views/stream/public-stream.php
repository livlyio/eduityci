
        <div class="row">
            <div class="col-md-12">
            
              <!-- The time line -->
              
         <ul class="timeline">
         <li>
         
         <?php $this->load->view('stream/post-box'); ?>
         </li>
        
        	<?php if($stream != FALSE): ?>
            	<?php $count = 0; ?>
            	<?php foreach($stream["posts"] as $post): 
                $post_id = $post['post_id']; 
                     if($post['attach_link'] != '0') {
                     	$attachment = '<div class="attachment"><h3>'; 
							switch($post['attach_type'])
							{
									case 'file':
									$attachment .= '<a title="download file" href="'.base_url().'download?file='.$post['attach_link'].'">'.$post['attach_link'].'</a>';
									$faicon = 'fa-file-pdf-o bg-orange';
                                    break;
								case 'video':
									$attachment .= '<a class="stream-vids" href="'.$post['attach_link'].'">Video</a>';
									$faicon = 'fa-video-camera bg-purple';
                                    break;
								case 'photo':
									$attachment .= '<a class="stream-photos" id="photo'.$post_id.'" href="'.base_url().'uploads/large_photos/'.$post['attach_link'].'" ><img src="'.base_url().'uploads/stream_photos/'.$post['attach_link'].'"  /></a>';
									$faicon = 'fa-picture-o bg-maroon';
                                    break;
								case 'link':
									$attachment .= '<div class="link-data" id="link'.$post_id.'"><a target="_new" id="'.$post_id.'" class="stream-links" href="'.$post['attach_link'].'">'.$post['attach_link'].'</a></div>';
									$faicon = 'fa-area-chart bg-red';
                                    break;
								case 'deleted':
									$attachment .= '<span class="deleted-attach">This attachment is either deleted or not availabe</span>';
									$faicon = 'fa-times bg-blue';
                                    break;
								default:
                                $attachment .= '';
                                $faicon = 'fa-quote-left bg-blue';                                                                                                
									break;		
							}
                            
                            $attachment .= '</h3></div>';
                    
                    } else { $attachment = ''; $faicon = 'fa-quote-left bg-blue'; }        
                   // die("TEST");
                  ?>
                <li>
                  <i class="fa <?php echo $faicon; ?>"></i>
                  <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> <?php echo $post['post_time']; ?></span>
                    <h3 class="timeline-header">
                   	<a href="<?php echo base_url().$post['user_name']; ?>"><?php echo $post['display_name']; ?></a>
                   	<?php if($post['posted_in'] != '0'): ?>
                   	<a href="<?php echo base_url().'groups/'.$post['group_name']; ?>" class="in"><?php echo $post['group_display']; ?></a>	
                    <?php endif; ?>
                    &nbsp; &nbsp; <span class="delete" id="d<?php echo $post_id; ?>"><a href="#" id="<?php echo $post_id; ?>" title="delete post"><img src="<?php echo base_url(); ?>images/del-norm.png" width="15" height="15"  /> Delete Post</a></span>
                    </h3>
                    
                    <div class="timeline-body">                
                    <h2><?php echo $post['post']; ?></h2>

                <?php $count++; ?>

                    
                     <?php echo $attachment; ?>
                          </div>
                    <div class='timeline-footer'>
                    <ul>
        
                    <input type="hidden" id="post-id" value="<?php echo $post['post_id']; ?>" />
                    


                	</li> 
                    </ul>
                   	<?php if($post['can_like'] == TRUE): ?>
                  		<a class="btn btn-success btn-xs" href="#" title="Like this post" class="like-post" id="<?php echo $post_id; ?>">Like</a>
                        <?php endif; ?>
                        &nbsp; &nbsp; 
                      <a class="btn btn-primary btn-xs">Read more</a>&nbsp; &nbsp; 
                      <a class="btn btn-danger btn-xs">Delete</a>&nbsp; &nbsp; 
                      <a class="btn btn-warning btn-xs">View Comments</a>&nbsp; &nbsp; 
                    </div>
                  </div>
                </li>
                <!-- END timeline item -->
                
                
                
            	<?php endforeach; ?>        
       		<?php endif; ?>
        </div>
        <?php if($stream != FALSE): ?>
        	<?php if($count > 15): ?>
        	<a href="#" id="load-more">load more posts</a>
            <?php endif; ?>
        <?php endif; ?>
        <div id="posts-loader">
        	<p></p>
        </div>
    </div>
</div>


