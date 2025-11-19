function get_bookings(search='')
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/new_bookings.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  xhr.onload = function(){
    document.getElementById('table-data').innerHTML = this.responseText;
  }

  xhr.send('get_bookings&search='+search);
}

function cancel_booking(id) 
{
  if(confirm("Bạn có chắc chắn muốn hủy đặt phòng này không?"))
  {
    let data = new FormData();
    data.append('booking_id',id);
    data.append('cancel_booking','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST","ajax/new_bookings.php",true);

    xhr.onload = function()
    {
      if(this.responseText == 1){
        alert('success','Đã hủy đặt phòng thành công!');
        get_bookings();
      }
      else{
        alert('error','Lỗi Server! Vui lòng thử lại sau.');
      }
    }

    xhr.send(data);
  }
}

window.onload = function(){
  get_bookings();
}