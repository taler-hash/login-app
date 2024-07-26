<template>
    <div class="w-screen h-full grid place-items-center">
        <Card>
            <template #title>Simple Card</template>
            <template #content>
                <p class="m-0">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error
                    repudiandae numquam deserunt quisquam repellat libero asperiores earum nam nobis, culpa ratione quam
                    perferendis esse, cupiditate neque
                    quas!
                </p>
            </template>
        </Card>
    </div>
</template>

<script>
import Card from 'primevue/card';

export default {
    components: {
        Card
    }
}
</script>