<h1>Trang này dành cho bác sĩ</h1>

<a href="{{route('doctors.logout')}}"
onclick="event.preventDefault(); document.querySelector('#logout-form').submit()";
>Đăng xuất</a>

<form id="logout-form" action="{{route('doctors.logout')}}" method="POST">
    @csrf
</form>
