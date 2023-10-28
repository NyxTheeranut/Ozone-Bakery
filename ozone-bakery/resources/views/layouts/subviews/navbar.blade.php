<nav class="bg-white border-gray-200 py-2.5">
    <div class="flex flex-wrap items-center justify-between max-w-screen-3xl mx-auto ">
        <a href="#" class="flex items-center ml-5">
            <img src="https://icons.veryicon.com/png/o/food--drinks/sweet-dessert-icon/croissant-18.png" class="h-6 mr-3 sm:h-9" alt="Logo">
            <span class="self-center text-1xl font-semibold whitespace-nowrap">Ozone Bakery</span>
        </a>
        <div class="flex items-center lg:order-2">
        
        <div class="flex items-center">
            <div class="dropdown">
                <a href="" class="ml-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 mr-3 sm:h-6" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                    </svg>
                    <span class="absolute top-0 right-0 inline-flex items-center w-3.5 h-3.5 mr-4 rounded-full border-2 border-white text-xs font-medium transform -translate-y-1/2 translate-x-1/2 bg-green-500 text-white">
                        <span class="sr-only">Badge value</span>
                    </span>
                </a>
            </div>
                <a class="ml-auto" href="{{ route("cart", ['user'=>Auth::user()])}}"
                   class="nav-menu {{ request()->is('cart') ? 'active' : '' }}">
                   <img src="https://cdn.icon-icons.com/icons2/2714/PNG/512/shopping_cart_thin_icon_171537.png" class="h- mr-3 sm:h-7" alt="Logo">
                </a>
           @if(Auth::check())
                <div class="mx-4 font-semibold" style="color: black;">
                    <div class="dropdown">
                        <h>{{ Auth::user()->name }}</h>
                        <div class="dropdown-content">

                            <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-stone-500">
                                <p class="text-sm text-gray-500 dark:text-gray-300">Signed in as</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-400">{{ Auth::user()->email }}</p>
                            </div>
                            
                            <a href="history" >Order History</a>
                            <a href=" {{ route("profile.index", ['user'=>Auth::user()])}} " >Profile</a>
        
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="text-md" type="submit">
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            @else
            <div class="mx-4 font-semibold" style="color: black;">
                
                <div class="dropdown">
                    <img src="https://static.thenounproject.com/png/4613668-200.png" class="h- mr-3 sm:h-9" alt="Logo">
                  <div class="dropdown-content">

                    

                    <a href="login">Sign in</a>
                    <a href="register">Register</a>
                    
                  </div>
                </div>
            </div>
           @endif
           
        </div>

            <button data-collapse-toggle="mobile-menu-2" type="button"
                    class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="mobile-menu-2" aria-expanded="true">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                          clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ url('/') }}" class="nav-menu {{ request()->is('/') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ url('/products') }}" class="nav-menu {{ request()->is('products') ? 'active' : '' }}">
                        Products
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->is_admin == 1)
                    <!-- Admin-specific navigation items go here -->
                    <li>
                        <a href="{{ url('/ingredients') }}" class="nav-menu {{ request()->is('ingredients') ? 'active' : '' }}">
                            Ingredients
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/customer-orders') }}" class="nav-menu {{ request()->is('customer-orders') ? 'active' : '' }}">
                           Customer orders
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ url('/custom-orders') }}" class="nav-menu {{ request()->is('custom-orders') ? 'active' : '' }}">
                           Custom Orders
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        
    </div>
</nav>
