<template>
    <div>
        <div
            class="flex h-32 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100"
            @dragover="dragover"
            @dragleave="dragleave"
            @drop="drop"
        >
            <label
                for="dropzone"
                class="flex h-full w-full cursor-pointer justify-center px-4"
            >
                <div
                    class="flex flex-col items-center justify-center pb-6 pt-5"
                >
                    <ReUploadCloud2Fill class="mb-3 h-10 w-10 text-gray-500" />
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <span class="font-semibold">
                            {{ __('Click to upload') }}
                        </span>
                        {{ __('or drag and drop') }}
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        MP4, PNG, JPG, WEBP or GIF (MAX. 800x400px)
                    </p>
                </div>

                <input
                    id="dropzone"
                    ref="inputFile"
                    type="file"
                    multiple
                    class="hidden"
                    accept=".jpg,.jpeg,.png,.gif,.webp,.mp4"
                    @input="uploadMedia"
                />
            </label>
        </div>

        <!-- files preview -->
        <div
            v-if="files && files.length > 0"
            class="my-2 flex flex-wrap gap-1 rounded bg-neutral-200 p-1"
        >
            <div
                v-for="(file, index) in files"
                :key="file.id"
                class="relative flex h-full w-full"
            >
                <template v-if="file.type === 'image'">
                    <div class="inline-flex h-[8rem]">
                        <AppImage
                            :src="file.url"
                            class="w-auto rounded border border-transparent object-cover shadow hover:border-primary-500"
                        />
                        <AppButton
                            class="absolute right-2.5 top-2.5 rounded-full bg-black bg-opacity-85 p-1 text-white"
                            @click="remove(index)"
                        >
                            <McDelete2Fill class="h-5 w-5" />
                        </AppButton>
                    </div>
                </template>
                <template v-else-if="file.type === 'video'">
                    <div class="inline-flex h-[30rem] w-full overflow-hidden">
                        <DefaultVideoPlayer :src="file.url" />
                    </div>
                </template>
            </div>
        </div>
        <!-- files preview -->
    </div>
</template>
<script setup>
import { ref } from 'vue';

import AppImage from '@Components/Shared/AppImage.vue';
import AppButton from '@Components/Form/AppButton.vue';
import DefaultVideoPlayer from '@Components/Shared/DefaultVideoPlayer.vue';

const inputFile = ref(null);

const isDragging = ref(false);

const files = ref([]);

const emit = defineEmits(['upload']);

const dragover = (e) => {
    e.preventDefault();
    isDragging.value = true;
};

const dragleave = () => (isDragging.value = false);

const drop = (e) => {
    e.preventDefault();

    inputFile.value.files = e.dataTransfer.files;

    uploadMedia(e.dataTransfer.files);
};

const uploadMedia = (event) => {
    const input = event.target;

    let count = input.files.length;

    let index = 0;

    if (input.files) {
        while (count--) {
            const type = input.files[index].type.substring(0, 5);

            if (type === 'image') {
                files.value.push({
                    id: index,
                    type: type,
                    url: URL.createObjectURL(input.files[index]),
                    source: input.files[index]
                });
            } else if (type === 'video') {
                files.value = [];

                console.log(files.value);
                files.value.push({
                    id: new Date().getTime(),
                    type: type,
                    url: URL.createObjectURL(input.files[index]),
                    source: input.files[index]
                });
            }

            emit('upload', files.value);

            index++;
        }
    }
};

const remove = (index) => {
    files.value.splice(index, 1);
    inputFile.value.value = null;

    emit('upload', files.value);
};
</script>
