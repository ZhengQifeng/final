<template>
	<div>
		<div class="classifiedProduct" v-bind:id="item.id">
			<div class="main-div">
				<div class="classifiedTitle" v-bind:style="{backgroundColor: item.backgroundColor}">
					<div class="title"><span>{{classIndex+1}}F/</span>{{item.name}}</div>
					<ul class="classift">
						<li v-for="item in item.classType">
							<a v-bind:href="fittingHref(item.fitting_ident)">{{item.name}}</a>
						</li>
					</ul>
				</div>
				<div class="classifiedMain">
					<div class="hoverChange" v-for="item in item.classifyParts">
						<a v-bind:href="partHref(item.id)">
							<div class="picture"><img v-bind:src="item.src" v-bind:alt="item.value"></div>
							<div class="sellerPrice">
								<div class="price">{{item.price}}</div>
								<div class="start">{{item.start}}</div>
							</div>
							<div class="sellerName"><p>{{item.value}}</p></div>
							<div class="sellerInformation">
								<div class="sellerName">{{item.seller.name}}</div>
								<div class="sellerName">{{item.seller.number}}</div>
							</div>
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
		methods: {
			partHref: function(val){
	            return `./fittingDetails?_id=${val}`;
	        },
	        fittingHref: function(val){
	            return `./searchProduct?fitting_ident=${val}`;
	        }
		},
		props: {
			item: {
				type: Object,
				required: true
			},
			classIndex: {
				type: Number,
				required: true
			}
		}
	}
</script>
<style scoped>
	.classifiedProduct{
		margin-top: 20px;
	}
	.main-div{
		display: flex;
	}
	.main-div>div{
		padding: 10px 0;
	}
	.classifiedTitle{
		display: flex;
		flex-direction: column;
		align-items: center;
		flex-shrink: 0;
		width: 220px;
		color: white;
	}
	.classifiedTitle>.title{
		display: flex;
		align-items: flex-end;
		font-size: .8rem;
	}
	.classift{
		display: flex;
		flex-wrap: wrap;
		width: 100%;
		padding-top: 20px;
	}
	.classift>li{
		padding: 5px;
		width: 50%;
		text-align: center;
		cursor: pointer;
		transition: .1s;
		opacity: .8;
	}
	.classift>li:hover{
		margin-top: -2px;
		opacity: 1;
	}
	.classifiedTitle>.title>span{
		margin-right: 10px;
		font-size: 1.1rem;
	}
	.classifiedMain{
		display: flex;
		flex-wrap: wrap;
		justify-content: space-between;
		flex-shrink: 1;
		overflow: hidden;
		width: 100%;
		margin-left: 10px;
		font-size: .6rem;
	}
	.classifiedMain>div{
		width: 160px;
		padding: 8px;
	}
	.picture{
		width: 100%;
	}
	.picture>img{
		width: 100%;
	}
	.classifiedMain>div>a>*{
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin: 2px 0;
	}
	.sellerName>p{
		width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
	.price{
		color: #1E8AE8;
		font-size: .8rem;
	}
	.sellerInformation{
		color: #888;
	}
</style>