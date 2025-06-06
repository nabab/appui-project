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
      const core = appui.plugins['appui-core'] + '/';

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
          icon: 'nf nf-md-apple_finder',
        }, {
          url: 'libraries',
          text: bbn._('Libraries'),
          icon: 'nf nf-cod-library',
        }, {
          url: 'i18n',
          text: bbn._('I18N'),
          icon: 'nf nf-md-translate',
        }
      ];
      bbn.fn.log(["PAGE " + page + ' ROOT ' + path, bits, this.source]);
      let pageSelected = page ? bbn.fn.search(menu, {url: page}) || 0 : 0;
      let databaseDb = '';
      let databaseHost = '';
      if ((page === 'database') && (bits.length > 2)) {
        databaseDb = bits[2];
        databaseHost = bits[1];
      }
      else if (this.source.project.db?.items?.length === 1) {
        databaseDb = this.source.project.db.items[0].code;
        if (this.source.project.db.items[0].items?.length) {
          const row = bbn.fn.getRow(this.source.project.db.items[0].items, {default: true});
          if (row) {
            databaseHost = row.code;
          }
        }
      }

      return {
        /** @data {String} ['project_ide/' + this.source.id_project + "/"] root Path to the root of the project */
        root,
        core,
        menu,
        pageSelected,
        databaseDb,
        databaseHost,
        databaseHostCopy: databaseHost,
        recentFiles: []
      };
    },
    computed: {
      connections() {
        if (this.databaseDb) {
          const db = bbn.fn.getRow(this.source.project.db.items, {code: this.databaseDb});
          if (db) {
            return db.items.map(a => {
              return {
                text: a.alias.text,
                value: a.alias.code
              }
            });
          }
        }

        return [];
      }      
    },
    methods: {
      onRoute(url) {
        const bits = url.split('/');
        this.pageSelected = bbn.fn.search(this.menu, {url: bits[0]});
        bbn.fn.log("PAGE SELECTED: " + this.pageSelected, bits)
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
      bbn.fn.post(appui.plugins['appui-ide'] + '/data/recent/files', d => {
        if (d.success) {
          this.recentFiles = d.data.map(a => {
            const bits = a.file.split('/_end_/');
            a.name = bits[0];
            a.ext = bits[1];
            if (a.type === 'components') {
              const tmp = a.name.split('/');
              tmp.splice(-1);
              a.name = tmp.join('/');
            }

            return a;
          });
        }
      })
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
      },
      databaseHost(v) {
        if (this.databaseHostTimeout) {
          clearTimeout(this.databaseHostTimeout);
        }

        this.databaseHostTimeout = setTimeout(() => {
          this.databaseHostCopy = this.databaseHost;
        }, 1000);
      }
    }
  };
})();