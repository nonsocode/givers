<template>
	<div class="gh-box gh mb-20">
		<div>
			<div class="h-header">
				<span class="inline-block gh-title h-title">
					<h4>Request to provide help</h4>
					<div class="ghid">GH Id:{{gh.id}}</div>
				</span>
				<i class="fa fa-arrow-circle-right gh-icon h-icon"></i>
			</div>
		</div>
		<div class="gh-body">
			<div class="fullname">Full name : {{fullname}}</div>
			<div class="amount">Amount: {{gh.amount}}</div>
			<div class="amount">Amount Paid: {{gh.amount_gotten}}</div>
			<div class="date">Date Created: {{gh.created_at}}</div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		props:['gh'],
		data(){
			return {};
		},
		computed:{
			fullname(){
				return this.gh.owner.first_name+" "+this.gh.owner.last_name;
			}
		}
	}
</script>