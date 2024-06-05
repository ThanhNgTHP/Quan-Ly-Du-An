<?php 

include_once getenv('DIR_CONTROLLERS').'\\image.php';

$current_directory_url = content_url().'/QL_Du_An/views/admin/image';

wp_enqueue_style( 'login_style', $current_directory_url.'/index.css' );

?>

<form action="" method="post">
    <input id="input-find" class="outline ml-[10px] p-[0_0_0_5px]" name="imageName" type="text" placeholder="Tìm Kiếm">
    <button id="btn-find" 
            name="method"
            value="find"
            type="submit"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
    >Tìm kiếm</button>
</form>

<div class="overflow-auto">
    <br>
    <br>
    <div class="text-xl grid grid-cols-6 gap-1 
                    w-[200%]
                    p-[25px_0_0_0]
                    m-[50px_0_0_0]
                    border-t-solid
                    border-t-2 
                    border-t-indigo-600" >
                    <div style="margin: auto;">Ảnh</div>
                    <div style="margin: auto;">Tên ảnh</div>
                    <div style="margin: auto;">Loại ảnh</div>
                    <div style="margin: auto;">Tên dự án</div>
                    <div style="margin: auto;">tên hợp đồng</div>
                    <div style="margin: auto;">Công cụ</div>
    </div>

    <form action="" method="post">
        <div class="grid grid-cols-6 gap-1 
                    w-[200%]
                    p-[25px_0_0_0]
                    m-[50px_0_0_0]
                    border-t-solid
                    border-t-2 
                    border-t-indigo-600">
                <div class="text-xl" style="margin: auto;">
                    <input type="file" name="path" value="">
                </div>

                <div class="text-xl" style="margin: auto;">
                    <input type="text" name="name" value="">
                </div>

                <div class="text-xl" style="margin: auto;">
                    <input type="text" name="imageCategory" value="">
                </div>

                <div class="text-xl" style="margin: auto;">
                    <select name="projectID" id="">
                        <?php foreach(Project::GetAllProject() as $key => $project): ?>
                            <option value="<?php echo $project->ID; ?>"><?php echo $project->Name; ?> - <?php echo $project->ID; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="text-xl" style="margin: auto;">
                    <select name="contractID" id="">
                        <?php foreach(Contract::GetAllContract() as $key => $contract): ?>
                            <option value="<?php echo $contract->ID; ?>"><?php echo $contract->Name; ?> - <?php echo $contract->ID; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>                

                <div style="margin: auto;">
                    <button type="submit" name="method" value="add" class="text-2xl bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                        Thêm
                    </button>
                </div>
        </div>

    </form>

    <?php foreach($images as $key => $image): ?>
    <form action="http://localhost/wordpress/wp-admin/admin.php?page=Dashboard&view=image" method="post" enctype="multipart/form-data">
        
        <div class="grid grid-cols-6 gap-1 
                    w-[200%]
                    p-[25px_0_0_0]
                    m-[50px_0_0_0]
                    border-t-solid
                    border-t-2 
                    border-t-indigo-600">

            <div class="text-xl hidden" style="margin: auto;">
                <input type="text" name="id" value="<?php echo $image->ID; ?>">
            </div>
                            
            <div class="relative">
                <input name="path" id="imageInput-<?php echo $key; ?>" class="imageInput hidden" type="file" accept="image/*">
                <img class="displayImage-<?php echo $key; ?> inline w-full" src="<?php echo $image->Path ?>" alt="<?php echo $image->Name ?>"> 
                
                <!-- <div class="absolute top-0 left-0 bottom-0 right-0">
                    <div class="w-0 h-0 border-l-[10px] border-l-transparent border-r-[10px] border-r-transparent border-b-[10px] border-b-solid border-b-blue-500"></div>
                    <div class="w-[20px] h-[20px] bg-red-600"></div>
                </div> -->

                <div class="absolute top-0 left-0 bottom-0 right-0">
                    <label for="imageInput-<?php echo $key; ?>">
                        <div class="w-full h-full hover:bg-white hover:opacity-50">
                        
                        </div>
                    </label>
                </div>
            </div>
            
            <div class="text-xl" style="margin: auto;">
                <input type="text" name="name" value="<?php echo $image->Name; ?>">
            </div>

            <div class="text-xl" style="margin: auto;">
                <input type="text" name="imageCategory" value="<?php echo $image->ImageCategory; ?>">
            </div>

            <div class="text-xl" style="margin: auto;">
                <select name="projectID" id="">
                    <?php $projectSelect = $image->GetImageProject(); ?>
                    <option value="<?php echo $projectSelect->ID; ?>"><?php echo $projectSelect->Name . '-' . $projectSelect->ID; ?></option>
                    <?php foreach(Project::GetAllProject() as $key => $project): ?>
                        <?php if($project->ID != $projectSelect->ID): ?>
                        <option value="<?php $project->ID; ?>"><?php echo $project->Name . '-' . $project->ID; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="text-xl" style="margin: auto;">
                <select name="contractID" id="">
                    <?php $contractSelect = $image->GetImageContract();?>
                    <option value="<?php echo $contractSelect->ID ?>"><?php echo $contractSelect->Name . '-' . $contractSelect->ID; ?></option>
                    <?php foreach(Contract::GetAllContract() as $key => $contract): ?>
                        <?php if($contractSelect->ID !== $contract->ID): ?>
                        <option  value="<?php echo $contract->ID ?>"><?php echo $contract->Name . '-' . $contract->ID; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="margin: auto;">
                    <button type="submit" name="method" value="edit" class="text-2xl bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Sửa
                </button>
                    <button type="submit" name="method" value="delete" class="text-2xl bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                    Xóa
                </button>
            </div>
        </div>
    </form>
    <?php endforeach; ?>    
</div>

<?php

wp_enqueue_script('tailwind_script', 'https://cdn.tailwindcss.com', array(), time(), true);
wp_enqueue_script( 'login_script', $current_directory_url.'/index.js', array(), time(), true);

?>