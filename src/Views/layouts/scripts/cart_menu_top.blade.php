<ul>
    <li class="">
        <a href="{{ url('/cart') }}" id="cart" class=""><?=(Cart::count()>0)?'Aveti '.Cart::count().' produse in cos':'Cos de cumparaturi'; ?></a>
    </li>
    @if(Auth::guard('customer')->check())
        <li class=""><a href="{{ url('/customer/profile') }}" class="">Profil [ {{ Auth::guard('customer')->user()->email }} ]</a></li>
        <li class=""><a href="{{ url('/customer/logout') }}" class="">Logout</a></li>
    @else
        <li class=""><a href="{{ url('/customer/login') }}" class="">Login</a></li>
        <li class=""><a href="{{ url('/customer/register') }}" class="">Cont nou</a></li>
    @endif
</ul>