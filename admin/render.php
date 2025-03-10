<?php

/*
* @author 友人a丶
* @date 2022/8/27
* 表单自定义的渲染函数
*/


/*
 * 输出本地化日志
 * */
function nicen_plugin_local_log() {

	$logs = ( ( Nicen_log::getInstance() )->get_logs() );

	echo '<a-form-item label="相关操作">';
	echo '<a-button type="primary" @click="clearLogs">清空插件日志</a-button>';
	echo '</a-form-item>';

	echo '
		<a-form-item label="详细日志">
		  <a-textarea
	            value="' . ( empty( $logs ) ? '暂无日志' : $logs ) . '"
	            :auto-size="{minRows: 5,maxRows:15}"
	            read-only/>
	';
	echo '</a-form-item>';


}


/*
 * 插件升级
 * */
function nicen_plugin_update() {

	echo '
		<a-form-item label="版本信息">
		  		当前版本（' . NICEN_VERSION . '）/ 最新版本（{{version}}）
	    </a-form-item>
	    <a-form-item label="BUG反馈">
		  		微信号good7341、Github提交issue、博客nicen.cn下方留言均可
	    </a-form-item>
	    <a-form-item label="仓库地址">
		  		Github：<a target="_blank" href="https://github.com/friend-nicen/nicen-localize-image">https://github.com/friend-nicen/nicen-localize-image</a>
				<br />
				Gitee：<a target="_blank" href="https://gitee.com/friend-nicen/nicen-localize-image">https://gitee.com/friend-nicen/nicen-localize-image</a>
				<br />
				博客：<a target="_blank" href="https://nicen.cn/2893.html">https://nicen.cn/2893.html</a>
				<br />
				仓库内的版本永远是最新版本，如您觉得插件给你带来了帮助，欢迎star！祝您早日达成自己的目标！
	    </a-form-item>
	     <a-form-item label="礼轻情意重">
	     
	      <a-popover placement="top" trigger="hover">
		    <template slot="content">
		      <img style="max-width:300px" :src="donate[0]"/>
		    </template>
		    
		    <a-button type="link">
		      微信捐赠
		    </a-button>
		    
		  </a-popover>
		  <a-popover placement="top" trigger="hover"> 
		  
		    <template slot="content">
		      <img style="max-width:300px" :src="donate[1]"/>
		    </template>
		    
		    <a-button type="link">
		      支付宝捐赠
		    </a-button>
		    
		  </a-popover>
		  <a-popover placement="top" trigger="hover">
		  
		    <template slot="content">
		     <img style="max-width:300px" :src="donate[2]"/>
		    </template>
		    
		    <a-button type="link">
		      QQ捐赠
		    </a-button>
		    
		  </a-popover>
	     		
	     		
	     		
	    </a-form-item>
	';

}

/*
 * 文章批量本地化
 * */
function form_batch() {

	$count = wp_count_posts();//文章总数
	$last=get_option('nicen_last_batch'); //上次本地化的ID

	/*
	 * 获取上次的ID
	 * */
	if(!empty($last)){
		$last='上次批量本地化的文章ID为：'.$last.'，';
	}

	echo '	<a-form-item label="功能说明">
	<div style="line-height: 1.8; width: 150%; overflow-wrap: break-word; word-spacing: normal; word-break: break-all;">
	按照指定的文章ID范围批量进行图片本地化，点击开始后任务自动运行，运行过程中可以随时暂停，关闭网页表示强制暂停！运行过程中将会展示实时日志！
	<br/><br/>
	'.$last.'当前共有已发布文章' . $count->publish . '篇，草稿' . $count->draft . '篇！不填起始ID默认批量本地化所有文章！
	</div>
	</a-form-item>
	<a-form-item label="文章ID范围">
	 <a-input-number v-model="batch.start" style=" width: 100px; text-align: center" placeholder="开始ID" /></a-input-number>
      <a-input
        style=" width: 30px; border-left: 0; pointer-events: none; backgroundColor: #fff"
        placeholder="~"
        disabled
      ></a-input>
      <a-input-number v-model="batch.end" style="width: 100px; text-align: center; border-left: 0" placeholder="结束ID">
  		</a-input-number>
		</a-form-item>';
	echo '<a-form-item label="相关操作">';
	echo '<a-button type="primary" :loading="batch.loading" @click="getBatch">{{batch.loading?"正在运行，点击取消运行...":"开始运行"}}</a-button>';
	echo '</a-form-item>';

}