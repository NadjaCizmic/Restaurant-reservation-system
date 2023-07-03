var CustomerService = {
    init: function () {
      $("#addCustomerForm").validate({
        submitHandler: function (form) {
          var customer = Object.fromEntries(new FormData(form).entries());
          CustomerService.addCustomer(customer);
          form.reset();
        },
      });
      $("#editCustomerForm").validate({
        submitHandler: function (form) {
          var customer = Object.fromEntries(new FormData(form).entries());
          CustomerService.editCustomer(customer);
        },
      });
  
      CustomerService.get_customers_rest();
    },
    getCustomers: function () {
      $.get("rest/customers", function (data) {
        var html = "";
        for (var i = 0; i < data.length; i++) {
          data[i].email = data[i].email ? data[i].email : "-";
          data[i].edit_customer =
            '<button class="btn btn-info" onClick="CustomerService.showEditDialog(' +
            data[i].id +
            ')">Edit Student</button>';
          data[i]._customer =
            '<button class="btn btn-danger" onClick="CustomerServicee.openConfirmationDialog(' +
            data[i].id +
            ')"> Student</button>';
        }
  
        Utils.datatable(
          "customers-table",
          [
            { data: "first_name", title: "First Name" },
            { data: "last_name", title: "Last Name" },
            { data: "phone", title: "Phone" },
            { data: "email", title: "Email" },
            { data: "edit_student", title: "Edit Student" },
            { data: "_student", title: " Student" },
          ],
          data
        );
  
        console.log(data);
      });
    },
  
    addCustomer: function (customer) {
      console.log("post");
      $.ajax({
        url: "rest/customers",
        type: "POST",
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        data: JSON.stringify(customer),
        contentType: "application/json",
        dataType: "json",
        success: function (customer) {
          $("#addCustomerModal").modal("hide");
          toastr.success("Customer has been added!");
          CustomerService.getCustomers();
        },
      });
    },
  
    showEditDialog: function (id) {
      $("#editStudentModal").modal("show");
      $("#editModalSpinner").show();
      $("#editStudentForm").hide();
      $.ajax({
        url: "rest/students/" + id,
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        type: "GET",
        success: function (data) {
          console.log(data);
          $("#edit_first_name").val(data.first_name);
          $("#edit_last_name").val(data.last_name);
          $("#edit_email").val(data.email);
          $("#edit_password").val(data.password);
          $("#edit_student_id").val(data.id);
          $("#editModalSpinner").hide();
          $("#editStudentForm").show();
        },
      });
    },
  
    editStudent: function (student) {
      console.log("edit");
      $.ajax({
        url: "rest/student/" + student.id,
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        type: "PUT",
        data: JSON.stringify(student),
        contentType: "application/json",
        dataType: "json",
        success: function (result) {
          toastr.success("Student has been updated successfully");
          $("#editStudentModal").modal("toggle");
          StudentService.getStudents();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          toastr.error("Error! Student has not been updated.");
        },
      });
    },
  
    openConfirmationDialog: function (id) {
      $("#deleteStudentModal").modal("show");
      $("#delete-student-body").html(
        "Do you want to delete student with ID = " + id
      );
      $("#student_id").val(id);
    },
  
    deleteStudent: function () {
      $.ajax({
        url: "rest/students/" + $("#student_id").val(),
        beforeSend: function (xhr) {
          xhr.setRequestHeader(
            "Authorization",
            localStorage.getItem("user_token")
          );
        },
        type: "DELETE",
        success: function (response) {
          console.log(response);
          $("#deleteStudentModal").modal("hide");
          toastr.success(response.message);
          StudentService.getStudents();
          //alert('deleted')
        },
        error: function (XMLHttpRequest, textStatus, errorThrow) {
          console.log("Error: " + errorThrow);
        },
      });
    },
    get_students_rest: function () {
      RestClient.get(
        "students",
        function (data) {
          for (var i = 0; i < data.length; i++) {
            data[i].email = data[i].email ? data[i].email : "-";
            data[i].edit_student =
              '<button class="btn btn-info" onClick="StudentService.showEditDialog(' +
              data[i].id +
              ')">Edit Student</button>';
            data[i].delete_student =
              '<button class="btn btn-danger" onClick="StudentService.openConfirmationDialog(' +
              data[i].id +
              ')">Delete Student</button>';
            
          }
  
          Utils.datatable(
            "students-table",
            [
              { data: "first_name", title: "Name" },
              { data: "last_name", title: "Surname" },
              { data: "password", title: "Password" },
              { data: "email", title: "Email" },
              { data: "edit_student", title: "Edit Student" },
              { data: "delete_student", title: "Delete Student" },
            ],
            data
          );
  
          console.log(data);
        },
        function (data) {
          toastr.error(data.responseText);
        }
      );
    },
  };
  