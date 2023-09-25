/**
  * @file project2 component
  *
  * @description Component use to initiate project data
  *
  * @copyright BBN Solutions
  *
  * @author Lucas Courteaud
  */

(() => {
  let mixins = [{
    props: {
      /**
       * An object with information about the current project
       *
       * @prop {Object} project
      */
      project: {
        type: Object
      }
    },
    data() {
      return {
        root: appui.plugins['appui-project'] + '/',

        /**
  				* Child component of luk-project2
  				*
  				* @data {Object} [null] projectComponent
  				*/
        projectComponent: null
      };
    },
    computed: {
      /**
  			* Data of the current project
 				*
  			* @computed projectData
  			* @return {Object}
  			*/
      projectData() {
        return this.project || (this.projectComponent ? this.projectComponent.source : null);
      }
    },
    /**
  		* @event created
  		*/
  }];
  return {
    data() {
      return {
        /**
  				* Path to the root of the project
  				*
  				* @data {String} ['project_ide/' + this.source.id_project + "/"] root
  				*/
        root: appui.plugins['appui-ide'] + '/project_ide/' + this.source.id_project + "/"
      };
    },
    methods: {
      /**
  			* Set the router with the container take in parameter
			  *
			  * @method route
			  * @param {Object} Container to set the router
			  */
      route(url) {
        let router = this.getRef("router");
        if (router) {
          router.route(url);
        }
      }
    },
    /**
  		* @event created
  		*/
    created() {
      if (!appui.projects) {
        appui.projects = {
          list: [{
            id: this.source.id_project
          }],
          options: {}
        };
      }
      else {
        appui.projects.list.push({id: this.source.id_project});
      }
    }
  };
})();