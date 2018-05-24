<template>
	<div>
		<div id="searchMain">
			<div class="main-div">
				<screenBox></screenBox>	
				<searchItems></searchItems>
			</div>
		</div>
	</div>
</template>
<script>
import screenBox from './screenBox.vue'
import searchItems from './searchItems.vue'
	export default{
		name: 'searchMain',
		components: {
			screenBox,
			searchItems
		}
	}
</script>
<style scoped>
	#searchMain{
		border-top: 1px solid #e5e5e5;
		padding-top: 10px;
	}
</style>