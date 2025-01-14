(()=>{
  return{
    data(){
      return{}
    },
    methods:{
      buttons(row, col, idx){
        return [{
          label: "IDE v1",
          action: row => {
            let link = appui.plugins['appui-project'] + '/router/' + row.project
                + '/' + appui.plugins['appui-ide'] + '/editor/';
            bbn.fn.link(link);
          },
          icon: 'nf nf-fa-code',
          title: bbn._('Go to I.D.E v1') + ' ('+row.project+')',
          notext: true
        }, {
          label: "IDE v2",
          action: row => {
            let link = appui.plugins['appui-project'] + '/ui/' + row.id;
            //bbn.fn.log("LINK IS " + link, row)
            bbn.fn.link(link, this);
          },
          class: 'bbn-primary',
          icon: 'nf nf-fa-code',
          title: bbn._('Go to I.D.E v2') + ' ('+row.project+')',
          notext: true
        }];
      }
    },
    components:{
      'toolbar':{
        template: `<div class="bbn-padding"><span class="bbn-b bbn-xxl">Projects</span></div>`,
      }
    }
  }
})();