<template>
    <form>
        <div class="modal-body">
            <div class="form-group">
                <input v-model="form.name" type="text" name="name" placeholder="Role Name"
                    class="form-control" :class="{'is-invaild': form.errors.has('name')}">
                <has-error :form="form" field="name"></has-error>

            </div>

               <b-form-group label="Assign Permissions">
                      <b-form-checkbox
                          v-for="option in permissions"
                          v-model="form.permissions"
                          :key="option.name"
                          :value="option.name"
                          name="flavour-3a"
                      >
                          {{ option.name }}
                      </b-form-checkbox>
                  </b-form-group>




        </div>
        <div class="modal-footer justify-content-between">
            <b-button type="submit" variant="primary" class="btn-lg btn-primary" v-if="!dis" disabled><b-spinner small type="grow"></b-spinner>Creating Role</b-button>
            <button type="submit"  v-if="dis" @click.prevent="createRole()" class="btn btn-lg btn-primary"><i class="fas fa-save"></i> Save Role</button>
        </div>
    </form>
</template>


<script type="text/javascript">

export default{

	data(){
		return{
			dis: true,
			permissions: [],
			form: new Form({
				'name' : '',
				'permission' : []
			}),
		}
	},

	methods: {
		getPermissions(){
			axios.get('http://localhost/laravel-admin-panel-permission-vue/public/getAllPermission')
			.then((response)=>{
				this.permissions = response.data.permissions
			}).catch((e)=>{
					swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: e,
					})
			});
		},

		createRole(){
			this.dis = false;
			this.form.post('http://localhost/laravel-admin-panel-permission-vue/public/postRole').then(()=>{
				swal.fire({
					  icon: 'success',
					  title: 'Role Created',
					  text: "Your role has been created successfully..",
					})
				// window.location = '/role';
			}).catch((e)=>{
				swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: e,
					})
			});
			// axios.post('/postRole', formData)
			// .then((response)=>{

			// })
			this.dis = true;
		},

	},

	created(){
		this.getPermissions();
	}
}

</script>
