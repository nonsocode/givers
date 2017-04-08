<template>
	<div>
		<ph-pair v-for="(phItem ,index) in phPairs" :ph-item="phItem"></ph-pair>
		<!-- <ph-pair></ph-pair> -->
	</div>
</template>

<script type="text/javascript">
	import PhPair from './phPair.vue';
	export default {
		components:{PhPair},
		props:['phPairs'],
		data(){
			return {
				// phPairs:[]
			}
		},
		created(){
			
		}
	}
</script>