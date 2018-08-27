<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker with time picker
    $('#newsTime').daterangepicker({ timePicker: true, timePickerIncrement: 15, format: 'DDMMYYYY h:mm A' }),

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
  })

        //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
  })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
  })
})
</script>