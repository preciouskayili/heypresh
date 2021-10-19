<style>
	.bg {
		background:
			linear-gradient(to right bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)),
			url('./img/img3.jpg');
		background-position: center;
		background-repeat: no-repeat;
	}

	.btn--rounded {
		border-radius: 2.5rem;
	}
</style>

<div class="col-md-12">
	<div class="card bg">
		<div class="card-body text-center">
			<h1 class="text-white" style="font-weight: 900; font-size: 5rem">OOPS 404 ERROR</h1>
			<p class="text-light">We could not find what you were looking for.</p>

			<button class="btn btn-warning btn-lg btn--rounded" onclick="location.href = './index.php'">
				Go home
				<span>
					<i class="fa fa-angle-right"></i>
				</span>
			</button>
		</div>
	</div>
</div>
