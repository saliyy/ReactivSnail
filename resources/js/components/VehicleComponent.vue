<template>
		<div>
		<a href=""><button
		 id="btn_admin" 
		 class="btn btn-sm btn-outline-danger 
		 content-hidden" @click="DeleteVehicle(vehicle_id)">Удалить</button></a>
		 	</div>
</template>

<script>
	export default{
		props: [
			'vehicle_id'
		],
		data(){
			return{
				vehicles: [],
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
				},
				vehicle_id: '',
				edit: false,
				loading: true,
				errored: false
			}
		},
		methods:{
			DeleteVehicle(id){
				axios
					.delete(`/api/vehicles/${id}`)
			}
		}
	}
</script>