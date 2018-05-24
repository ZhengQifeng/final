<template>
	<div>
		<div id="carBrand">
			<div class="main-div">
				<div class="brandTitle">热门品牌</div>
				<div class="brandMain">
					<div class="brandItem hoverChange" v-for="item in cars" v-bind:dataId = "item.id">
						<a v-bind:href="brandHref(item.brand_ident)">
							<img v-bind:src="item.src" v-bind:alt="item.value">
							<p>{{item.value}}</p>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default{
		name: 'carBrand',
		data(){
			return {
				cars: brand
			}
		},
		methods: {
			brandHref: function(val){
	            return `./searchProduct?brand_ident=${val}`;
	        }
		}
	}
</script>
<style scoped>
	#carBrand{
		margin-top: 20px;
	}
	.brandTitle{
		display: inline-block;
		width: 162px;
		height: 40px;
		padding-left: 20px;
		display: flex;
		align-items: center;
		background-color: #1E8AE8;
		color: white;
		font-size: 0.9rem;
		font-weight: 500;
	}
	.brandMain{
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		width: 100%;
		border: 2px solid #1E8AE8;
		padding: 10px 5px;
	}
	.brandItem>a{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-between;
		width: 120px;
		height: 136.6px;
		margin-top: 10px;
		padding-top: 10px;
	}
	.brandItem img{
		width: 80px;
		height: 80px;
		cursor: pointer;
	}
	.brandItem p{
		display: flex;
		justify-content: center;
		align-items: center;
		width: 106.6px;
		height: 30px;
	}
</style>