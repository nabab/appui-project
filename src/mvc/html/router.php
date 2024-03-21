<div class="bbn-overlay bbn-padded">
  <bbn-table ref="table"
             :source="source.data"
             class="bbn-w-100"
             :toolbar="$options.components.toolbar"
             :order="[{field: 'project', dir: 'ASC'}]">
    <bbns-column title="<?= _("Project") ?>"
                 field="project"
                 :sortable="false"/>

    <bbns-column title="APP"
                 field="app"
                 :width="100"
                 cls="bbn-c"/>
  
    <bbns-column title="CDN"
                 field="cdn"
                 :width="100"
                 cls="bbn-c"/>
    
    <bbns-column title="LIB"
               	 field="lib"
                  :width="100"
                 cls="bbn-c"/>

    <bbns-column title="<?= _("Total repositories") ?>"
                 field="repositories"
                 :width="200"
                 cls="bbn-c"/>
    <bbns-column :buttons="buttons"
                 :width="130"/>
  </bbn-table>
</div>