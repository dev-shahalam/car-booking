<div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Car</h5>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" action="{{'/create-car'}}" method="post">
                    @csrf
                    <div class="container">
                        <div class="row">
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Car Name</label>
                                    <input name="car_name" type="text" class="form-control" id="carName">

                                    <label class="form-label mt-2">Model</label>
                                    <input name="model" type="text" class="form-control" id="model">

                                    <label class="form-label mt-2"> Status </label>
                                    <select name="status" type="text" class="form-control form-select" id="status">
                                        {{--                                    <option value="">Select Status</option>--}}
                                        <option value="available" selected>Available</option>
                                        <option value="rented">Rented</option>
                                        <option value="under_maintenance">Under Maintenance</option>
                                    </select>

                                </div>
                                <div class="col-6 p-1">
                                    <label class="form-label mt-2">Make Year</label>
                                    <input name="make_year" type="text" class="form-control" id="makeYear">

                                    <label class="form-label mt-2">Daily Rent</label>
                                    <input name="daily_rent" type="text" class="form-control" id="dailyRent">

                                    <label class="form-label mt-2"> Description </label>
                                    <input name="description" type="text" class="form-control" id="description">

                                </div>


                                <div class="col-12 p-1">
                                    <br/>
                                    <img class="w-15" id="image" src="{{asset('images/default.jpg')}}"/>
                                    <br/>

                                    <label class="form-label">Image</label>
                                    <input name="image" oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file" class="form-control" id="productImg">
                                </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="modal-close" class="btn bg-gradient-primary mx-2" data-bs-dismiss="modal"
                                aria-label="Close">Close
                        </button>
                        <button onclick="Save()" type="submit" id="save-btn" class="btn bg-gradient-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{--<script>--}}


{{--    // FillCategoryDropDown();--}}
{{--    // async function FillCategoryDropDown() {--}}
{{--    //     let res = await axios.get("/list-category")--}}
{{--    //     res.data.forEach(function (item, i) {--}}
{{--    //         let option = `<option value="${item['id']}">${item['name']}</option>`--}}
{{--    //         $("#productCategory").append(option);--}}
{{--    //     })--}}
{{--    // }--}}


{{--    async function Save() {--}}

{{--        let car_name = document.getElementById('carName').value;--}}
{{--        let model = document.getElementById('model').value;--}}
{{--        let status = document.getElementById('status').value;--}}
{{--        let make_year = document.getElementById('makeYear').value;--}}
{{--        let daily_rent = document.getElementById('dailyRent').value;--}}
{{--        let description = document.getElementById('description').value;--}}
{{--        let image = document.getElementById('image').files[0];--}}

{{--        if (productCategory.length === 0) {--}}
{{--            errorToast("Product Category Required !")--}}
{{--        } else if (productName.length === 0) {--}}
{{--            errorToast("Product Name Required !")--}}
{{--        } else if (productPrice.length === 0) {--}}
{{--            errorToast("Product Price Required !")--}}
{{--        } else if (productUnit.length === 0) {--}}
{{--            errorToast("Product Unit Required !")--}}
{{--        } else if (!productImg) {--}}
{{--            errorToast("Product Image Required !")--}}
{{--        } else {--}}

{{--            document.getElementById('modal-close').click();--}}

{{--            let formData = new FormData();--}}
{{--            formData.append('img', productImg)--}}
{{--            formData.append('name', productName)--}}
{{--            formData.append('price', productPrice)--}}
{{--            formData.append('unit', productUnit)--}}
{{--            formData.append('category_id', productCategory)--}}

{{--            const config = {--}}
{{--                headers: {--}}
{{--                    'content-type': 'multipart/form-data'--}}
{{--                }--}}
{{--            }--}}

{{--            showLoader();--}}
{{--            let res = await axios.post("/create-car", formData, config)--}}
{{--            hideLoader();--}}

{{--            if (res.status === 201) {--}}
{{--                successToast('Request completed');--}}
{{--                document.getElementById("save-form").reset();--}}
{{--                await getList();--}}
{{--            } else {--}}
{{--                errorToast("Request fail !")--}}
{{--            }--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}
