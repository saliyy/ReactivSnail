<template>
	<div>
		<div v-if="errors" >
				<div v-if="ValidateErrors" class="alert alert-danger">
					<ul>
						<li v-for="(value, index) in ValidateErrors" :key="index">	
							{{ value }}
						</li>
					</ul>
			</div>
		</div>

		<div v-if="image_error == true" class="alert alert-danger">
			<li>Фотография обязательна к загрузке</li>
		</div> 

		
		<button class="btn btn-success" v-on:click="visible=!visible">{{visible?'Закрыть редактор':'Добавить технику'}}</button>
		<form @submit.prevent="addVehicle" v-show="visible">
			<div class="form-group">
			    <label for="exampleFormControlInput1">Марка транспорта</label>
			    <input type="text" v-model="vehicle.brand" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Год выпуска</label>
			    <input type="number" v-model="vehicle.start_use" min="1980" max="2020" class="form-control">
			  </div>
			   <div class="form-group">
			    <label for="exampleFormControlInput1">Категория</label>
			     <select class="form-control" v-model="vehicle.category" id="exampleFormControlSelect1">
			      <option>Легковая</option>
			      <option>Грузовик</option>
			      <option>Фургон</option>
			      <option>Спецтехника</option>
			    </select>
			  </div>
			    <div class="form-group">
			    <label for="exampleFormControlInput1">Состояние транспорта</label>
			    <input type="text" v-model="vehicle.current_state" class="form-control">
			  </div>
			  <div class="form-group">
			    <label for="exampleFormControlFile1">Фотография транспорта</label>
			    <input type="file" name="image"  @change="sync" class="form-control-file" id="exampleFormControlFile1">
			  </div>
			  <button type="submit" class="btn btn-success">Сохранить</button>
		</form>
	</div>
</div>
</template>

<script>
	export default{
		computed: {
			ValidateErrors(){

				let errors = Object.values(this.errors)

				errors = errors.flat()

				return errors

			}
		},
		data(){
			return{
				visible: false,
				image_error: false,
				show_errors: false,
				vehicle: {
					id: '',
					driver_id: '',
					brand: '',
					start_use: '',
					category: '',
					current_state: '',
					status: '',
					img_id: '',
					photo: '',
					errors: [], 
				},
				edit: false,
				loading: true,
				errored: false
			}
		},
		methods: {
			addVehicle(){


				let data = new FormData();
				
				data.append('brand', this.vehicle.brand)
				data.append('start_use', this.vehicle.start_use)
				data.append('category', this.vehicle.category)
				data.append('current_state', this.vehicle.current_state)

				if(this.image == null){

		        	this.image_error = true;
		        }else{

		        	data.append('image', this.image);
		        }
				

				axios.post('/api/vehicles', data).then(response => {
					console.log(response)
					console.log(this.vehicle.brand)
					console.log(this.vehicle.start_use)
					console.log(this.vehicle.category)
					console.log(this.vehicle.current_state)
					console.log(this.image)

				}).catch(error => {
				     if (error.response.status == 422){
				     	this.visible = false;
				       this.errors = error.response.data.errors;}
		      })},
			 sync (e) {
		        e.preventDefault();
		        this.image = e.target.files[0];

		        
		    }
		}
	}
</script>

