<template>
  <v-app>
   <v-main>
     <v-container fluid>
      <v-card  class="mx-auto">
        <v-app-bar dark  color="primary">
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
        <v-toolbar-title>Al - Sharq</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-title>{{dataHelper}}   </v-toolbar-title>
        <v-spacer></v-spacer>
          <v-toolbar-title>  <v-select
                                v-model="filters.category_id"
                                :items="dataCategory"
                                item-text="name"
                                item-value="id"
                                label="Categories"
                                required
							                	clearable
                                filled
								                @change="getPages"
                            ></v-select></v-toolbar-title>

       <v-btn icon>
    
      </v-btn>
                                                    
                      
    </v-app-bar>
    <v-container>
      <v-row >
     
        <v-col sm="12" md="12" lg="6" v-for="(data,index) in dataList" :key="index">
               <v-card  class="mx-auto" >
                  <v-img class="white--text align-end"   height="200px" src="https://cdn.vuetifyjs.com/images/cards/docks.jpg" >
                    <v-card-title>{{data.title}}</v-card-title>
                  </v-img>
                 
                      <v-card-text class="text--primary">
                        <v-card-subtitle>Body</v-card-subtitle>
                        <div v-html="data.body"></div>
                      </v-card-text>

                      
                   </v-card>
        </v-col>
      </v-row>
      <div class="text-center">
                                <v-pagination
                                v-model="filters.page"
                                :length="pageCount"
                                @input="getPages"
                                ></v-pagination>
                            </div>
    </v-container>
   </v-card>
     </v-container>
   </v-main>
  

    <Footer></Footer>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    isLeftbar: false,
    items: [],
    dataList: [],
    dataCategory:[],
    dataHelper:'',
    itemsPerPage:1,
        pageCount:2,
        filters:
        {
			page: 1,
      show: 20,
        },
        
  }),
  components: {
   
  },
  created() 
  {
   this.initialize();
  },

  methods: {
    async initialize() 
    {
        try 
			 {
        		let { data } = await axios({
          		method: "get",
          		url: "/app/category"
        		});
        		this.dataCategory = data;
			} 
			catch (e) 
			{

      }
         try 
			 {
        		let { data } = await axios({
          		method: "get",
          		url: "/app/helper"
        		});
        		this.dataHelper = data;
			} 
			catch (e) 
			{

			}
      this.getPages();
    },

    async getPages()
		{
			this.start();
			try 
			{
				let { data } = await axios({
					method: "get",
					url: "/app/pages",
					 params: this.filters
				});
				this.dataList = data.data;
                this.itemsPerPage=data.per_page;
                this.pageCount=data.last_page;
                this.filters.page=data.current_page
				
			} 
			catch (e) 
			{
				this.fail();
			}
			finally
			{
				this.finish();
			}
		},
  },

};
</script>