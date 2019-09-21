<script>
	$('.show-user-info').on('click', function(){
		let user  = JSON.parse( $(this).attr('userInfo') );
		$('.userName').text( user.User.name==null?'N/A':user.User.name );
		$('.email-text').text(user.User.email == null?'N/A':user.User.email);
		$('.country-text').text(user.User.country == null?'N/A':user.User.country);
		$('.state-text').text(user.User.state == null?'N/A':user.User.state);
		let add = user.User.address;
		$('.address-text').text(add == null?'N/A':user.User.address);
		$('.contact-text').text( user.User.contact == null?'N/A':user.User.contact );
		$('.usertype-text').text( user.User.type == '2'?'Seeker':'Provider' );
		// $('.organization-text').text( user.Organisation.name == null?'N/A':user.Organisation.name );
		// $('.designation-text').text( user.Designation.name == null?'N/A':user.Designation.name );
		// $('.department-text').text( user.Department.name == null?'N/A':user.Department.name );
		$('#myModal').modal('show');
	});
</script>