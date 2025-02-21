<?php

?>

<ul class="nav menu">
	<li <?php if ($page[0] == 'dashboard') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'dashboard') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'dashboard"';
		} ?>><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
	</li>

	<?php if ($page[0] == 'user'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> User List</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'input nota'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> Input Invoice</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'input surat jalan'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> Input SJ</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'input service center'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> Input SC</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'invoice list'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> Invoice List</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'detail invoice'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em>Detail Invoice</a>
		</li>
	<?php endif; ?>

	<?php if ($page[0] == 'input-order'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa fa-chevron-circle-down">&nbsp;</em> Input Order</a>
		</li>
	<?php endif; ?>

	<li <?php if ($page[0] == 'new') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'new') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'order-new/"';
		} ?>><em class="fa fa-plus color-blue">&nbsp;</em> New Order</a>
	</li>

	<?php if ($page[0] == 'detail-new'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa-chevron-circle-down">&nbsp;</em> Detail New</a>
		</li>
	<?php endif; ?>

	<li <?php if ($page[0] == 'proses') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'proses') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'order-proses/"';
		} ?>><em class="fa fa-cogs color-orange">&nbsp;</em> On Proccess</a>
	</li>

	<?php if ($page[0] == 'detail-proses'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa-chevron-circle-down">&nbsp;</em> Detail Proses</a>
		</li>
	<?php endif; ?>

	<li <?php if ($page[0] == 'done') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'done') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'order-done/"';
		} ?>><em class="fa fa-check color-green">&nbsp;</em> Done</a>
	</li>

	<?php if ($page[0] == 'detail-done'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa-chevron-circle-down">&nbsp;</em> Detail Done</a>
		</li>
	<?php endif; ?>

	<li <?php if ($page[0] == 'abort') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'abort') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'order-abort/"';
		} ?>><em class="fa fa-times color-red">&nbsp;</em> Abort</a>
	</li>

	<?php if ($page[0] == 'detail-abort'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa-chevron-circle-down">&nbsp;</em> Detail Abort</a>
		</li>
	<?php endif; ?>

	<li <?php if ($page[0] == 'pickup') {
		echo 'class="active"';
	} ?>>
		<a <?php if ($page[0] == 'pickup') {
			echo 'href="javascript:void(0)"';
		} else {
			echo 'href="' . $page[1] . 'order-pickup/"';
		} ?>><em class="fa fa-handshake-o color-purple">&nbsp;</em> Pick Up</a>
	</li>

	<?php if ($page[0] == 'detail-pickup'): ?>
		<li style="background-color:#c4e3e9;">
			<a style="padding-left: 2em;" href="javascript:void(0)"><em class="fa fa-chevron-circle-down">&nbsp;</em> Detail Pickup</a>
		</li>
	<?php endif; ?>

	<?php if (in_array($_SESSION['akses'], ['master', 'admin'])): ?>
		<?php if (!in_array($page[0], ['suplier', 'nota', 'surat jalan'])) {
			$collapse = 'collapse';
		} else {
			$collapse = '';
		} ?>
		<li class="parent ">
			<a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-address-book">&nbsp;</em> ADMIN
				<span data-toggle="collapse" href="#sub-item-2" class="icon pull-right">
					<em class="fa fa-chevron-down"></em>
				</span>
			</a>
			<ul class="children <?= $collapse; ?>" id="sub-item-2">
				<li>
					<a <?php if ($page[0] == 'suplier') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'order-service-center/"';
					} ?>>
						<span class="fa fa-map-marker">&nbsp;</span> Service Center
					</a>
				</li>
				<li>
					<a <?php if ($page[0] == 'nota') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'order-invoice/"';
					} ?>>
						<span class="fa fa-address-card">&nbsp;</span> Invoice
					</a>
				</li>
				<li>
					<a <?php if ($page[0] == 'surat jalan') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'order-surat-jalan/"';
					} ?>>
						<span class="fa fa-envelope">&nbsp;</span> Surat Jalan
					</a>
				</li>
			</ul>
		</li>
	<?php endif; ?>

	<!-- EARNINGS -->
	<?php if ($_SESSION['akses'] != 'master'): ?>
		<?php if (!in_array($page[0], ['queue', 'pending', 'paid'])) {
			$collapse = 'collapse';
		} else {
			$collapse = '';
		} ?>
		<li class="parent ">
			<a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-usd">&nbsp;</em> EARNINGS
				<span data-toggle="collapse" href="#sub-item-2" class="icon pull-right">
					<em class="fa fa-chevron-down"></em>
				</span>
			</a>
			<ul class="children <?= $collapse; ?>" id="sub-item-2">

				<li>
					<a <?php if ($page[0] == 'queue') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'dashboard"';
					} ?>>
						<span class="fa fa-folder">&nbsp;</span> Queue
					</a>
				</li>
				<li>
					<a <?php if ($page[0] == 'pending') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'dashboard"';
					} ?>>
						<span class="fa fa-hourglass-half">&nbsp;</span> Pending
					</a>
				</li>
				<li>
					<a <?php if ($page[0] == 'paid') {
						echo 'class="col-active" href="javascript:void(0)"';
					} else {
						echo 'href="' . $page[1] . 'dashboard"';
					} ?>>
						<span class="fa fa-paypal">&nbsp;</span> Paid
					</a>
				</li>
			</ul>
		</li>
	<?php endif; ?>

	<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
			<em class="fa fa-users">&nbsp;</em> USERS <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
		</a>
		<ul class="children collapse" id="sub-item-1">

			<!-- disi dengan ajax -->

		</ul>
	</li>

	<li class="parent "><a data-toggle="collapse" href="#setting">
			<em class="fa fa-cog">&nbsp;</em> SETTING <span data-toggle="collapse" href="#setting" class="icon pull-right"><em class="fa fa-chevron-down"></em></span>
		</a>
		<ul class="children collapse" id="setting">
			<?php if ($_SESSION['akses'] == 'master' && $page[0] != 'user'): ?>
				<li>
					<a href="<?= $page[1]; ?>order-user">
						<span class="fa fa-user-plus">&nbsp;</span> View User
					</a>
				</li>
			<?php endif; ?>
			<li>
				<a id="password" class="" href="javascript:void(0)">
					<span class="fa fa-key">&nbsp;</span> Change Password
				</a>
			</li>
			<?php if ($_SESSION['akses'] == 'master'): ?>
				<li>
					<a id="version" class="" href="javascript:void(0)" onclick="updateVersion('<?= $version; ?>')">
						<span class="fa fa-code-fork">&nbsp;</span> Update Version
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</li>

	<li><a href="<?php echo $page[1]; ?>logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
</ul>