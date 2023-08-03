function base_url() {
    var pathparts = location.pathname.split('/');
    var url;

    if (location.host == 'localhost') {
        url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
    }else{
        url = location.origin + "/"; // http://stackoverflow.com/
    }
    return url;
}

const elem = document.querySelector('input[name="schedule_date"]');
var dateToday = new Date();
var minDate = dateToday.setDate(dateToday.getDate() + 1);
var maxDate = dateToday.setMonth(dateToday.getMonth() + 2);

const datepicker = new Datepicker(elem, {
    daysOfWeekDisabled: [3],
    minDate: minDate,
    maxDate: maxDate,
    clearButton: true,
    autohide: true
});

const scheduleDateInput = document.getElementById('schedule_date');

scheduleDateInput.addEventListener('changeDate', function() {
    resetScheduleTime();

    var url = base_url() + 'api/reservation/get_sched_time_by_date?schedule_date=' + $("input[name='schedule_date']").val();
    $.getJSON(url, function(response) {
        let schedTimeArr = response['list'];

        schedTimeArr.forEach(element => {
            $("select[name=schedule_time] option[value='" + element + "']").remove();
        });
    });
});

function resetScheduleTime(){
    $('select[name=schedule_time]').empty().append('<option selected disabled>Select Schedule Time</option>');
    $('select[name=schedule_time]').append($('<option>').val('9am-10am').text('9am-10am'));
    $('select[name=schedule_time]').append($('<option>').val('10am-11am').text('10am-11am'));
    $('select[name=schedule_time]').append($('<option>').val('11am-12pm').text('11am-12pm'));
    $('select[name=schedule_time]').append($('<option>').val('12pm-1pm').text('12pm-1pm'));
    $('select[name=schedule_time]').append($('<option>').val('1pm-2pm').text('1pm-2pm'));
    $('select[name=schedule_time]').append($('<option>').val('2pm-3pm').text('2pm-3pm'));
    $('select[name=schedule_time]').append($('<option>').val('3pm-4pm').text('3pm-4pm'));
    $('select[name=schedule_time]').append($('<option>').val('4pm-5pm').text('4pm-5pm'));
}

function reserveBooking(){
	$("#frmReserveBooking").submit(function(e) {
		e.preventDefault();
		var formAction = e.currentTarget.action;
		var formData = new FormData(this);
		var formType = "POST";
		
		Swal.fire({
			title: 'Confirmation',
			text: "Are you sure you want to continue?",
			icon: 'warning',
			showCancelButton: true,
			reverseButtons: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes!'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: formAction,
					type: formType,
					data: formData,
					processData: false,
					contentType: false,
					cache: false,
					async: false,
					success: function(data) {
						var obj = JSON.parse(data);
							
						if(obj.flag === 0){
							Swal.fire(
								'Error!',
								obj.msg,
								'error'
							);
						}else{
							Swal.fire({
								title: 'Success!',
								text: obj.msg,
								icon: 'success',
								allowOutsideClick: false,
								allowEscapeKey: false,
								showCancelButton: false,
								confirmButtonText: 'Ok, Got It!'
							}).then((result) => {
								if (result.value) {
									location.replace(base_url() + 'reservation');
								}
							});
						}
					},
					error: function(xhr, status, error){
						var errorMessage = xhr.status + ': ' + xhr.statusText;
						Swal.fire(
							'Error!',
							errorMessage,
							'error'
						);
					 }
				});	
			}
		});
	});
}

reserveBooking();