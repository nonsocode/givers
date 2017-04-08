<template>
	<div>
		<gh-pair v-for="(ghItem ,index) in ghPairs" :gh-item="ghItem"></gh-pair>
		<!-- <gh-pair></gh-pair> -->
	</div>
</template>

<script type="text/javascript">
	import GhPair from './ghPair.vue';
	export default {
		components:{GhPair},
		props:['ghPairs'],
		data(){
			return {
				// ghPairs:[]
			}
		},
		created(){
			
		}
	}
</script>