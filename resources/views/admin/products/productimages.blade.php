<h1 style="text-align: center;">Products Images</h1>
<div class="aligner">
									<div class="owl-carousel owl-theme">
										@if(count($products)>0)
											@foreach($products as $product_image)
												<div style="text-align: center;width: 60%;" class="item">
													<a href="https://localhost/newscreenpod/public/admin/clip-one/assets/products/original/{{$product_image->image}}" data-lightbox="gallery">
													<img style="width: 60%;" src="https://localhost/newscreenpod/public/admin/clip-one/assets/products/original/{{$product_image->image}}" alt="">
													</a>
												</div>
											@endforeach
										@endif	
									</div>
								</div>