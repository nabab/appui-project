<div class="bbn-overlay bbn-padding">
  <bbn-table ref="table"
             :source="source.data"
             class="bbn-w-100"
             :toolbar="$options.components.toolbar"
             :order="[{field: 'project', dir: 'ASC'}]">
    <bbns-column label="<?= _("Project") ?>"
                 field="project"
                 :sortable="false"/>

    <bbns-column label="APP"
                 field="app"
                 :width="100"
                 cls="bbn-c"/>
  
    <bbns-column label="CDN"
                 field="cdn"
                 :width="100"
                 cls="bbn-c"/>
    
    <bbns-column label="LIB"
               	 field="lib"
                  :width="100"
                 cls="bbn-c"/>

    <bbns-column label="<?= _("Total repositories") ?>"
                 field="repositories"
                 :width="200"
                 cls="bbn-c"/>
    <bbns-column :buttons="buttons"
                 :width="130"/>
  </bbn-table>
</div>