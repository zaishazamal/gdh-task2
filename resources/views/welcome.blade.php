<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
    <title>Task 2</title>
</head>
<body>
<div class="container" id="app">
    <br><br><br><br>

    <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#addEmployee" @click="showAddEmployeeModal()">
        Add Employee
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@{{ update ? 'Edit' : 'Add' }} Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="#" method="post" @submit="addEmployee($event)">
                    @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" v-model="formData.name" placeholder="Full Name" required>
                    </div>
                    <div class="form-group">
                        <label for="Gender">Gender:<span class="text-danger">*</span></label>
                        <select name="gender" class="form-control" v-model="formData.gender" required>
                            <option value="">Select Gender</option>
                            <option v-for="(gender, index) in genderList" :value="gender">@{{ gender.charAt(0).toUpperCase() + gender.slice(1) }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department:<span class="text-danger">*</span></label>
                        <input type="text" name="department" class="form-control" v-model="formData.department" placeholder="Department Name" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:<span class="text-danger">*</span></label>
                        <input type="text" name="city" class="form-control" v-model="formData.city" placeholder="City Name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="showEmployee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">@{{ update ? 'Edit' : 'Add' }} Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>@{{ formData.name }}</td>
                            </tr>
                            <tr>
                                <td>Gender</td>
                                <td>@{{ formData.gender.charAt(0).toUpperCase() + formData.gender.slice(1) }}</td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>@{{ formData.department }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>@{{ formData.city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card card-body" v-cloak>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Department</th>
                        <th scope="col">City</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(employee, index) in employees">
                        <th scope="row">@{{ index+1 }}</th>
                        <td>@{{ employee.name }}</td>
                        <td>@{{ employee.gender.charAt(0).toUpperCase() + employee.gender.slice(1) }}</td>
                        <td>@{{ employee.department }}</td>
                        <td>@{{ employee.city }}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addEmployee" @click="showEditEmployeeModal(employee)">
                                Edit
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#showEmployee" @click="showEmployeeModal(employee)">
                                Details
                            </button>
                            <form action="#" style="display: inline-block" @submit="deleteEmployee($event, employee.id)">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            employees: [],
            genderList: ['male', 'female', 'common'],
            formData: {
                name: null,
                gender: '',
                department: null,
                city: null,
            },
            update: false,
        },
        mounted() {
            this.getEmployees();
        },
        methods: {
            getEmployees() {
                axios
                    .get('{{ route('employees.index') }}')
                    .then(res => {
                        this.employees = res.data;
                    })
                    .catch(err => {
                        toastr.error('Internal Server Error!');
                    });
            },
            addEmployee: function (e) {
                e.preventDefault();

                if (!this.update) {
                    axios
                        .post('{{ route('employees.store') }}', this.formData)
                        .then(res => {
                            if (res.data.status === 'success') {
                                this.getEmployees();
                                toastr.success('Employee successfully added!');
                                $('#addEmployee').modal('hide');
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch(err => {
                            toastr.error('Internal Server Error!');
                        });
                } else {
                    this.updateEmployee();
                }
            },
            updateEmployee() {
                axios
                    .patch('/employees/' + this.update, this.formData)
                    .then(res => {
                        if (res.data.status === 'success') {
                            this.getEmployees();
                            toastr.success('Employee successfully updated!');
                            $('#addEmployee').modal('hide');
                        } else {
                            toastr.error(res.data.message);
                        }
                    })
                    .catch(err => {
                        toastr.error('Internal Server Error!');
                    });
            },
            deleteEmployee: function (e, id) {
                e.preventDefault();

                if (confirm('Are you sure?')) {
                    axios
                        .delete('/employees/' + id)
                        .then(res => {
                            if (res.data.status === 'success') {
                                this.getEmployees();
                                toastr.success('Employee successfully deleted!');
                                $('#addEmployee').modal('hide');
                            } else {
                                toastr.error(res.data.message);
                            }
                        })
                        .catch(err => {
                            toastr.error('Internal Server Error!');
                        });
                }
            },
            showAddEmployeeModal() {
                this.formData.name = null;
                this.formData.gender = '';
                this.formData.department = null;
                this.formData.city = null;
                this.update = false;
            },
            showEditEmployeeModal(employee) {
                this.formData.name = employee.name;
                this.formData.gender = employee.gender;
                this.formData.department = employee.department;
                this.formData.city = employee.city;
                this.update = employee.id;
            },
            showEmployeeModal(employee) {
                this.formData.name = employee.name;
                this.formData.gender = employee.gender;
                this.formData.department = employee.department;
                this.formData.city = employee.city;
            }
        }
    });
</script>
</body>
</html>
