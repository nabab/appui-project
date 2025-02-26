<div class="bbn-overlay bbn-padding">
  <bbn-table ref="table"
             :source="source.data"
             class="bbn-w-100"
             :toolbar="$options.components.toolbar"
             :order="[{field: 'project', dir: 'ASC'}]">
    <bbns-column label="<?= _("Project") ?>"
                 field="project"
                 :sortable="false"
                 :min-width="200"/>

    <bbns-column label="APP"
                 field="app"
                 :width="70"
                 cls="bbn-c"/>
  
    <bbns-column label="CDN"
                 field="cdn"
                 :width="70"
                 cls="bbn-c"/>
    
    <bbns-column label="LIB"
               	 field="lib"
                  :width="70"
                 cls="bbn-c"/>

    <bbns-column label="<?= _("Tot. repo.") ?>"
                 flabel="<?= _("Total number of repositories") ?>"
                 field="repositories"
                 :min-width="70"
                 cls="bbn-c"/>
    <bbns-column :buttons="buttons"
                 :width="80"/>
  </bbn-table>
</div>