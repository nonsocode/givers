<template>
	<div class="ph-box ph mb-20">
		<div>
			<div class="h-header">
				<i class="fa fa-arrow-circle-right h-icon ph-icon"></i>
				<span class="inline-block ph-title h-title">
					<h4>Request to provide help</h4>
					<div class="phid">PH Id:{{ph.id}}</div>
				</span>
			</div>
		</div>
		<div class="ph-body">
			<div class="fullname">Full name : {{fullname}}</div>
			<div class="amount">Amount: {{ph.amount}}</div>
			<div class="amount">Amount Paid: {{ph.amount_paid}}</div>
			<div class="date">Date Created: {{ph.created_at}}</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		props:['ph'],
		data(){
			return {};
		},
		computed:{
			fullname(){
				return this.ph.owner.first_name+" "+this.ph.owner.last_name;
			}
		}
	}
</script>