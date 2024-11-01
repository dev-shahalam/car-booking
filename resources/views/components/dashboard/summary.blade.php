<div class="container-fluid">
    <div class="row">


        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain shadow-sm h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="product">{{$car->count()}}</span>
                                </h5>
                                <p class="mb-0 text-sm">Total Cars</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain shadow-sm h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="category">{{$rental->count()}}</span>
                                </h5>
                                <p class="mb-0 text-sm">Rental Ongoing</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 shadow-sm bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="invoice">{{$totalPrice->count()}}</span>
                                </h5>
                                <p class="mb-0 text-sm">Rental Completed</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain shadow-sm h-100 bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    <span id="customer">{{$customer->count()}}</span>
                                </h5>
                                <p class="mb-0 text-sm">Customer</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100 shadow-sm bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    BDT <span id="total">{{$totalPrice->sum('total_price')}}</span>
                                </h5>
                                <p class="mb-0 text-sm">Total Sale</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100  bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    $ <span id="vat"></span>
                                </h5>
                                <p class="mb-0 text-sm">Vat Collection</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12 animated fadeIn p-2">
            <div class="card card-plain h-100  bg-white">
                <div class="p-3">
                    <div class="row">
                        <div class="col-9 col-lg-8 col-md-8 col-sm-9">
                            <div>
                                <h5 class="mb-0 text-capitalize font-weight-bold">
                                    $ <span id="payable"></span>
                                </h5>
                                <p class="mb-0 text-sm">Total Collection</p>
                            </div>
                        </div>
                        <div class="col-3 col-lg-4 col-md-4 col-sm-3 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow float-end border-radius-md">
                                <img class="w-100 " src="{{asset('images/icon.svg')}}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
</div>

{{-- BDT 179973.61 --}}



<script>
    getList();
    async function getList() {
        // showLoader();
        let res=await axios.get("/summary");

        document.getElementById('car').innerText=res.data['product']
        document.getElementById('category').innerText=res.data['category']
        document.getElementById('customer').innerText=res.data['customer']
        document.getElementById('invoice').innerText=res.data['invoice']
        document.getElementById('total').innerText=res.data['total']
        document.getElementById('vat').innerText=res.data['vat']
        document.getElementById('payable').innerText=res.data['payable']

        hideLoader();
    }
</script>
