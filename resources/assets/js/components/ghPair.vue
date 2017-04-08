<template>
<div class="pair-box gh">
	<table class="receipt-table">
		<tr>
			<th>Status</th>
			<th>Created</th>
			<th>Amount</th>
			<th>Donor</th>
		</tr>
		<tr>
			<td>
				<div class="pair-gh-status">
					<img :src="statusImage"><br>
					<div class="pair-gh-id">
						Transaction Id<br>
						{{ghItem.id}}
					</div>
				</div>
			</td>
			<td>
				<div class="pair-gh-created">{{date}}</div>
			</td>
			<td>
				<div class="pair-gh-amount">{{ghItem.amount}}</div>
			</td>
			<td>
				<div class="pair-gh-recepient">
					<div class="recepient-name">{{pher_name}}</div>
					<div class="pair-gh-recepient-ghone"><a :href="'tel:'+phone" class="btn btn-primary"><i class="fa fa-phone"></i>&nbsp;{{phone}}</a></div>
					<div class="pay-now-div text-right"><button class="pay-now">Pay Now</button></div>
				</div>
			</td>
		</tr>
	</table>
</div>
</template>
<script type="text/javascript">
	let Moment = require('moment');
	export default {
		name:'gh-pair',
		props: ['ghItem'],
		data(){
			return {
			}
		},
		mounted(){
		},
		created(){
			
		},
		computed : {
			date(){
				return Moment(this.ghItem.created_at).format('MMMM Do, hh:mm a');
			},

			statusImage(){
				return 4;
			},
			pher_name(){
				return this.ghItem.ph.owner.first_name+" "+ this.ghItem.ph.owner.last_name;
			},
			phone(){
				return this.ghItem.ph.owner.phone
			}
		}
	}
</script>