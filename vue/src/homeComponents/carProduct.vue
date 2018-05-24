<template>
	<div>
		<div id="carProduct">
			<div class="main-div">
				<div class="productTitle">热门产品</div>
				<div class="productMain">
					<div class="productItem hoverChange" v-for="item in cars" v-bind:dataId = "item.id">
						<a v-bind:href="partHref(item.id)">
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
		name: 'carProduct',
		data(){
			return {
				cars: hotParts
			}
		},
		methods: {
			partHref: function(val){
	            return `./fittingDetails?_id=${val}`;
	        }
		}
	}
</script>
<style scoped>
	#carProduct{
		margin-top: 20px;
	}
	.productTitle{
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
	.productMain{
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		width: 100%;
		border: 2px solid #1E8AE8;
		padding: 10px 5px;
	}
	.productItem{
		width: 15%;
	}
	.productItem>a{
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-between;
		width: 100%;
		height: 138px;
		padding-top: 10px;
		margin-top: 10px;
	}
	.productItem img{
		width: 100px;
		height: auto;
		max-height: 100px;
		cursor: pointer;
	}
	.productItem p{
		text-align: center;
		width: 100%;
		padding: 0px 15px;
		font-size: 0.6rem;
		height: 30px;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
</style>