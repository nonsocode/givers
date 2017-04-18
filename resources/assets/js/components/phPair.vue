<template>
<div class="pair-box ph">
	<table class="receipt-table">
		<tr>
			<th>Status</th>
			<th>Created</th>
			<th>Amount</th>
			<th>Recepient</th>
		</tr>
		<tr>
			<td>
				<div class="pair-ph-status">
					<img :src="statusImage"><br>
					<div class="pair-ph-id">
						Transaction Id<br>
						{{phItem.id}}
					</div>
				</div>
			</td>
			<td>
				<div class="pair-ph-created">{{date}}</div>
			</td>
			<td>
				<div class="pair-ph-amount">{{phItem.amount}}</div>
			</td>
			<td>
				<div class="pair-ph-recepient">
					<div class="recepient-name">{{gher_name}}</div>
					<div class="pair-ph-recepient-phone"><a :href="'tel:'+phone" class="btn btn-primary"><i class="fa fa-phone"></i>&nbsp;{{phone}}</a></div>
					<div class="pay-now-div text-right"><button class="pay-now">Pay Now</button></div>
				</div>
			</td>
		</tr>
	</table>
</div>
</template>
<script type="text/javascript">
	import Moment from 'moment';
	export default {
		name:'ph-pair',
		props: ['phItem'],
		data(){
			return {
			}
		},
		mounted(){
			console.log('mounted');
		},
		created(){
			
		},
		computed : {
			date(){
				return Moment(this.phItem.created_at).format('MMMM Do, hh:mm a');
			},
			statusImage(){
				return 4;
			},


			gher_name(){
				return this.phItem.gh.owner.first_name+" "+ this.phItem.gh.owner.last_name;
			},
			phone(){
				return this.phItem.gh.owner.phone
			}
		}
	}
</script>