<div class="bbn-overlay bbn-padded">
  <bbn-table ref="table"
             :source="source.data"
             class="bbn-w-100"
             :toolbar="$options.components.toolbar"
             :order="[{field: 'project', Dir: 'ASC'}]"
  >
    <bbns-column title="<?=_("Project")?>"
                 field="project"
                 :sortable="false"
    ></bbns-column>

    <bbns-column title="APP"
                 field="app"
                 cls="bbn-c"
    ></bbns-column>
  
    <bbns-column title="CDN"
                 field="cdn"
                 cls="bbn-c"
    ></bbns-column>
    
    <bbns-column title="LIB"
               	 field="lib"
                 cls="bbn-c"
    ></bbns-column>

    <bbns-column title="<?=_("Total repositories")?>"
                 field="repositories"
                 cls="bbn-c"
    ></bbns-column>
    <bbns-column :buttons="buttons"
                 :width="130"
    ></bbns-column>
  </bbn-table>
</div>