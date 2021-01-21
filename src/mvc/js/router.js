(()=>{
  return{
    data(){
      return{}
    },
    methods:{
      getIDE(row){
        let link = appui.plugins['appui-project'] + '/router/' + row.project
            + '/' + appui.plugins['appui-ide'] + '/editor/';
        bbn.fn.log(row,link)
        bbn.fn.link(link, true);
      },
      buttons(row, col, idx){
        return [{
          text: "Info",
          action:()=>{
            this.getIDE(row);
          },
          icon: 'nf nf-fa-code',
          title: bbn._('Go to I.D.E') + ' ('+row.project+')',
          notext: true
        }];
      }
    },
    components:{
      'toolbar':{
        template: `<div class="bbn-padded"><span class="bbn-b bbn-xxl">Projects</span></div>`,
      }
    }
  }
})();