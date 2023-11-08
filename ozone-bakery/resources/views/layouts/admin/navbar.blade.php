<nav class="bg-white border-gray-200 py-2.5">
    <div class="flex flex-wrap items-center justify-between max-w-screen-3xl mx-auto ">
        <h href="/" class="flex items-center ml-5">
            <img src="https://icons.veryicon.com/png/o/food--drinks/sweet-dessert-icon/croissant-18.png" class="h-6 mr-3 sm:h-9" alt="Logo">
            <span class="self-center text-1xl font-semibold whitespace-nowrap">Ozone Bakery</span>
        </h>
        <div class="flex items-center lg:order-2">

            <div class="flex items-center">
                <div class="dropdown">
                </div>
                @if (Auth::check())
                <div class="mx-4 font-semibold" style="color: black;">
                    <div class="dropdown">
                        <h>{{ Auth::user()->name }}</h>
                        <div class="dropdown-content">

                            <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-stone-500">
                                <p class="text-sm text-gray-500 dark:text-gray-300">Logged in as</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-gray-400">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>
                            <a href=" {{ route('profile.index', ['user' => Auth::user()]) }} ">Profile</a>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="text-md " type="submit">
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



                            <a href="login">Log in</a>
                            <a href="register">Register</a>

                        </div>
                    </div>
                </div>
                @endif

            </div>

            <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="mobile-menu-2" aria-expanded="true">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
                <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        <div class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
            <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                <li>
                    <a href="{{ url('/orders') }}" class="nav-menu {{ request()->is('customer-orders') ? 'active' : '' }}">
                        Orders
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/products') }}" class="nav-menu {{ request()->is('products') ? 'active' : '' }}">
                        Products
                    </a>
                </li>
                <li>
                    <a href="{{ url('/ingredients') }}" class="nav-menu {{ request()->is('ingredients') ? 'active' : '' }}">
                        Ingredients
                    </a>
                </li>
                <li>
                    <a href="{{ url('/stocks') }}" class="nav-menu {{ request()->is('stocks') ? 'active' : '' }}">
                        Stocks
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
<style>
    .dropdown {
        position: relative;
        display: inline-block;
    }

    /* Style for the dropdown button */
    .dropbtn {
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    /* Style for the dropdown content */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        left: -110px;
        /* Adjust this value to determine how far to the left it should open */
    }

    /* Style for dropdown links */
    .dropdown-content a {
        color: black;
        padding: 12px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content button {
        color: black;
        padding: 12px;
        text-decoration: none;
        display: block;
        width: fill;
        text-align: left;
    }

    /* Change link color on hover */
    .dropdown-content a:hover {
        background-color: #9f948f;
        color: white;
    }

    .dropdown-content button:hover {
        background-color: #9f948f;
        color: white;
    }


    /* Show the dropdown content on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .container {
        position: relative;
        max-width: 430px;
        width: 100%;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 0 20px;
    }

    .container .forms {
        display: flex;
        align-items: center;
        height: 440px;
        width: 200%;
        transition: height 0.2s ease;
    }


    .container .form {
        width: 50%;
        padding: 30px;
        background-color: #fff;
        transition: margin-left 0.18s ease;
    }

    .container.active .login {
        margin-left: -50%;
        opacity: 0;
        transition: margin-left 0.18s ease, opacity 0.15s ease;
    }

    .container .signup {
        opacity: 0;
        transition: opacity 0.09s ease;
    }

    .container.active .signup {
        opacity: 1;
        transition: opacity 0.2s ease;
    }

    .container.active .forms {
        height: 600px;
    }

    .container .form .title {
        position: relative;
        font-size: 27px;
        font-weight: 600;
    }

    .form .title::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 30px;
        background-color: #4070f4;
        border-radius: 25px;
    }

    .form .input-field {
        position: relative;
        height: 50px;
        width: 100%;
        margin-top: 30px;
    }

    .input-field input {
        position: absolute;
        height: 100%;
        width: 100%;
        padding: 0 35px;
        border: none;
        outline: none;
        font-size: 16px;
        border-bottom: 2px solid #ccc;
        border-top: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .input-field i {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
        font-size: 23px;
        transition: all 0.2s ease;
    }

    .input-field i.icon {
        left: 0;
    }

    .input-field i.showHidePw {
        right: 0;
        cursor: pointer;
        padding: 10px;
    }

    .form .checkbox-text {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
    }

    .checkbox-text .checkbox-content {
        display: flex;
        align-items: center;
    }

    .checkbox-content input {
        margin-right: 10px;
        accent-color: #4070f4;
    }

    .form .text {
        color: #333;
        font-size: 14px;
    }

    .form a.text {
        color: #4070f4;
        text-decoration: none;
    }

    .form a:hover {
        text-decoration: underline;
    }

    .form .button {
        margin-top: 35px;
    }

    .form .button input {
        border: none;
        color: #fff;
        font-size: 17px;
        font-weight: 500;
        letter-spacing: 1px;
        border-radius: 6px;
        background-color: #8c8276;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .button input:hover {
        background-color: #5b5852;
    }

    .form .login-signup {
        margin-top: 30px;
        text-align: center;
    }
</style>