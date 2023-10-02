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
  return {
    props: {
      source: {
        type: Object,
        validator(d) {
          return d.project && d.project.id;
        }
      }
    },
    data() {
      const root = appui.plugins['appui-project'] + '/ui/' + this.source.project.id + "/"
      const path = bbn.env.path.substr(root.length);
      const bits = path.split('/');
      const page = bits[0] || '';
      const menu = [
        {
          url: 'home',
          text: bbn._('Home'),
          icon: 'nf nf-fa-home',
        }, {
          url: 'ide',
          text: bbn._('IDE'),
          icon: 'nf nf-fa-code',
        }, {
          url: 'database',
          text: bbn._('Database'),
          icon: 'nf nf-fa-database',
        }, {
          url: 'finder',
          text: bbn._('Finder'),
          icon: 'nf nf-mdi-apple_finder',
        }, {
          url: 'libraries',
          text: bbn._('Libraries'),
          icon: 'nf nf-cod-library',
        }, {
          url: 'i18n',
          text: bbn._('I18N'),
          icon: 'nf nf-mdi-translate',
        }
      ];
      bbn.fn.log(["PAGE " + page + ' ROOT ' + path, bits, this.source]);
      let pageSelected = page ? bbn.fn.search(menu, {url: page}) || 0 : 0;
      let databaseDb = '';
      let databaseHost = '';
      if (page && (bits[1] === 'database') && bits.length > 2) {
        databaseDb = bits[2];
        if (bits[3]) {
          databaseHost = bits[3];
        }
      }

      return {
        /** @data {String} ['project_ide/' + this.source.id_project + "/"] root Path to the root of the project */
        root,
        menu,
        pageSelected,
        databaseDb,
        databaseHost,
      };
    },
    computed: {
      connections() {
        if (this.databaseDb) {
          const db = bbn.fn.getRow(this.source.project.db.items, {code: this.databaseDb});
          if (db) {
            return db.items;
          }
        }

        return [];
      }      
    },
    methods: {
      onRoute(url) {
        const bits = url.split('/');
        this.pageSelected = bbn.fn.search(this.menu, {url: bits[0]});
      },
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
    },
    mounted() {
      this.route(this.menu[this.pageSelected].url);
    },
    watch: {
      pageSelected(i) {
        if (this.menu[i]) {
          this.route(this.menu[i].url);
        }
      },
      databaseDb(v) {
        if (this.databaseDb && this.databaseHost) {
          this.getRef('dbRouter').route('database/' + this.databaseDb + '/' + this.databaseHost + '');
        }
      }
    }
  };
})();