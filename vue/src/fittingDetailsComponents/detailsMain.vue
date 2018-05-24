<template>
	<div>
		<div id="detailsMain">
			<div class="main-div">
				<detailsNews></detailsNews>
			</div>
		</div>
	</div>
</template>
<script>
import detailsNews from './detailsNews.vue'
	export default{
		name: 'detailsMain',
		components: {
			detailsNews
		}
	}
</script>
<style scoped>
	#detailsMain{
		border-top: 1px solid #e5e5e5;
    	padding-top: 40px;
	}
</style>