<ul class="nav navbar-nav">
    <li><a href="{{ url('/home') }}">Home</a></li>

        @if(Auth::user())
        @if(Auth::user()->role == "admin")

            <li><a href="{{ route('admin.categories.index') }}">Categorias</a></li>
            <li><a href="{{ route('admin.products.index') }}">Produtos</a></li>
            <li><a href="{{ route('admin.clients.index') }}">Clientes</a></li>
            <li><a href="{{ route('admin.orders.index') }}">Pedidos</a></li>
            <li><a href="{{ route('admin.cupons.index') }}">Cupons</a></li>

        @elseif(Auth::user()->role == "client")

            <li><a href="{{ route('customer.order.index') }}">Meus pedidos</a></li>

        @endif
        @endif
</ul>