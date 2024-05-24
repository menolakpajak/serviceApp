<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="<?= $page[1]; ?>"><span>Sinar </span>Service</a>
				<ul class="nav navbar-top-links navbar-right">
					
						<ul class="dropdown-menu dropdown-messages msg-notif">

							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
<?php if(in_array($_SESSION['akses'],['master','admin'])) :?>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info"><?= count($notif) ; ?></span>
					</a>
						<ul class="dropdown-menu dropdown-messages msg-notif">
							<?php if(isset($pin)) :?> 
							<li><a href="<?= $page[1]; ?>order-pin/">
									<div><em class="fa fa-thumb-tack"></em> <strong class="color-red"><?= count($pin) ; ?></strong> Pinned Order to execute
										<span class="pull-right text-muted small color-gray">go this first</span></div>
								</a>
							</li>
							<?php endif; ?>
							<li class="divider"></li>
							<?php if(!empty($notif)) :?>
								<?php foreach($notif as $notif_info) :?>
									<?php 
										if($notif_info['status'] == 'new'){ 
											$notif_icon = 'fa fa-plus color-blue';
											$notif_msg = 'Pending to check';
										}
										if($notif_info['status'] == 'proses'){ 
											$notif_icon = 'fa fa-cogs color-orange';
											$notif_msg = 'Not being confirmed';
										}
										if($notif_info['status'] == 'done'){ 
											$notif_icon = 'fa fa-check color-green';
											$notif_msg = 'Not Picked up yet';
										}
										if($notif_info['status'] == 'abort'){ 
											$notif_icon = 'fa fa-times color-red';
											$notif_msg = 'Not Picked up yet';
										}
											
if($notif_info['klik'] == 'no'){
	$border = 'style="background-color: #8883835c;"';
}else {
	$border = '';
}
											
									$date_msg = strtotime($notif_info['date']);
									
										$remain = $now - $date_msg;
										if($remain <= 60 ){
											$time =  $remain . ' secs ago';
										}elseif( $remain > 60 && $remain <= 3600){
											$time = ceil($remain / 60). ' mins ago';
										}elseif($remain > 3600 && $remain <= 86400 ){
											$time = ceil($remain / 3600). ' hours ago';
										}elseif($remain > 86400 && $remain <= 604800 ){
											$time = ceil($remain / 86400). ' days ago';
										}elseif($remain > 604800 && $remain <= 29030400 ){
											$time = ceil($remain / 604800). ' weeks ago';
										
										}else{ $time = '> 3 months ago'; }
											
						
									?>
									<?php $days = round(($now - strtotime($notif_info['date_info']))/(3600*24)); ?>
									<li <?= $border ; ?>><a href="<?= $page[1]; ?>action/notif_check.php?nospk=<?= $notif_info['no_spk'] ; ?>">
										<div><em class="<?= $notif_icon ; ?>"></em> <strong><?= ucfirst($notif_info['nama']) ; ?><br></strong> >> <?= $days ; ?> days <strong><?= $notif_msg ; ?></strong>
											<span class="pull-right text-muted small color-gray"><?= $time ; ?></span></div>
											
									</a></li>
									<li class="divider"></li>
								<?php endforeach; ?>
							<?php endif; ?>
							<!-- <li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li> -->
							<!-- <li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li> -->
						</ul>
					</li>
<?php endif; ?>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>