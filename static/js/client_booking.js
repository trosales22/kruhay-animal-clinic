const elem = document.querySelector('input[name="schedule_date"]');
var dateToday = new Date();
var minDate = dateToday.setDate(dateToday.getDate() + 1);
var maxDate = dateToday.setMonth(dateToday.getMonth() + 2);

const datepicker = new Datepicker(elem, {
    daysOfWeekDisabled: [3],
    minDate: minDate,
    maxDate: maxDate,
    clearButton: true
});