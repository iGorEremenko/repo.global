////////Код jQuery, установливающий маску для ввода телефона элементу input
//маскирую номер тедефона под маску набора номера телефона
$(function(){
    //получаю элемент по id который у нужного input
    $("#number").mask("+38(999) 999-99-99");
});

//     Внимание: По умолчанию в качестве заполнителя маски используется знак нижнего подчеркивания ('_').


//////////////////Если в качестве заполнителя Вы хотите использовать что-то другое, 
то его можно указать посредством параметра placeholder 
//следующим образом:

<!--HTML элемент, который будет иметь заполнитель дд.мм.гггг -->
<input  id="date" type="text">
<!--HTML элемент, который будет иметь в качестве заполнителя пробел -->
<input  id="index" type="text">
<script>
$(function() {
  //задание заполнителя с помощью параметра placeholder
  $("#date").mask("99.99.9999", {placeholder: "дд.мм.гггг" });
  //задание заполнителя с помощью параметра placeholder
  $("#index").mask("999999", {placeholder: " " });
});
</script>



///////////////////////Кроме placeholder данный плагин имеет ещё параметр completed. Он предназначен для задания действий,
//которые будут выполнятся после того как пользователь завершит ввод маски ввода.
//Например, выведем с помощью метода alert сообщение пользователю, когда он завершит ввод маски телефона:

<!-- Ввод номера телефона осуществляется с помощью маски  -->
<input  id="phone" type="text">
<script>
$(function(){
  //Использование параметра completed
  $("#phone").mask("8(999) 999-9999", {
    completed: function(){ alert("Вы ввели номер: " + this.val()); }
  });
});
</script>


/////////////////////////Иногда бывают такие ситуации, когда одна часть маски является обязательной для заполнения,
//а другая часть нет.
//Чтобы это указать, в Masked Input используется знак '?'. Этот знак является специальным символом, 
//после которого необходимо разместить часть маски необязательной для заполнения.
//Например, пользователю необходимо ввести число от 0 до 0.99. 
//При этом обязательным для заполнения является указание хотя бы одного знака после запятой.

<!-- Ввод номера телефона осуществляется с помощью маски  -->
<input  id="number" type="text">
<script>
jQuery(function($){
  //создания своего специального символа для маски
  $("#number").mask("0.9?9");
});
</script>




//////////////////////////Плагин Masked Input позволяет использовать в маске кроме предопределенных 
//специальных знаков (9, a, *) свои собственные.
//Например, создадим для маски специальный символ ~, который при вводе будет автоматом заменён на знак (+) или минус (-).

<!-- HTML элемент, имеющий маску телефона -->
<input  id="number" type="text">
<script>
jQuery(function($){
  //создания специального символа для маски
  $.mask.definitions['~']='[+-]';
  $("#number).mask("~9.99");
});
</script>




///////////////////////////Например, создадим маску для ввода CSS цвета в шестнадцатеричном формате:

<!-- HTML элемент, имеющий маску для ввода цвета в шестнадцатиричном формате -->
<input  id="color" type="text">
<script>
jQuery(function($){
  //создания специального символа h для маски
 $.mask.definitions['h']='[A-Fa-f0-9]';
  $("#color).mask("#hhhhhh");
});
</script>







///////////////////////////////Пример создания маски ввода телефона
//Рассмотрим пример создания маски для ввода телефона в зависимости от выбранной страны: нужно выбрать страну и потом маска
//адаптирует начало ввода номера под код страны
<div class="form-group">
  <label for="phone">Телефон: </label>
  <select id="country" class="form-control">
    <option value="ru"><img src="">Россия +7</option>
    <option value="ua">Украина +380</option>
    <option value="by">Белоруссия +375</option>
  </select>
  <input id="phone" type="text" class="form-control">
</div>
 
<script>
jQuery (function ($) {  
  $(function() {
    function maskPhone() {
      var country = $('#country option:selected').val();
      switch (country) {
        case "ru":
          $("#phone").mask("+7(999) 999-99-99");
          break;
        case "ua":
          $("#phone").mask("+380(999) 999-99-99");
          break;
        case "by":
          $("#phone").mask("+375(999) 999-99-99");
          break;          
      }    
    }
    maskPhone();
    $('#country').change(function() {
      maskPhone();
    });
  });
});
</script>
